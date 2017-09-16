/*
*/
package main

import (
    "fmt"
    "time"
    "github.com/go-redis/redis"
    "encoding/json"
    "bytes"
    "strings"
    "net/url"
    "log"
)

func main() {
    ticker := time.NewTicker(5 * time.Second)
    quit := make(chan struct{})
    
    // Create a redis client
    client := redis.NewClient(&redis.Options{
        Addr:       "localhost:9787",
        Password:   "Boogy*Man225",
        DB:         0,
    })
    
    for {
        select {
            case <- ticker.C:
                // Grab the last job in the queue, FIFO
                job, err := client.RPop("jobs").Result()
                if err != nil {
                    continue
                }
                
                // Log the delivery time
                log.Println("Pulling available job")
                
                // Get the starting time
                startingTime := time.Now().UTC()
                
                // Unencode the json
                var req map[string]interface{}
                error := json.Unmarshal([]byte(job), &req)
                if error != nil {
                    fmt.Println( "There was an error un-encoding the json" )
                    panic( error )
                }
                
                // Retrieve the raw post data
                endpoint := req["endpoint"].(map[string]interface{})["url"].(string)
                data := req["data"].([]interface{})
                
                // Grab all data elements and replace them in the endpoint string
                for _, element := range data {
                    element = element.(map[string]interface{})
                    
                    for key,val := range element.(map[string]interface{}) {
                        var buf bytes.Buffer
                        buf.WriteString("{")
                        buf.WriteString(key)
                        buf.WriteString("}")
                        endpoint = strings.Replace(endpoint, buf.String(), url.QueryEscape(val.(string)), -1)
                    }
                }
                
                // Restructure the postback string
                postback := "GET " + endpoint
                
                // Get the ending time
                endingTime := time.Now().UTC()
                
                // Calculate the processing time
                var duration time.Duration = endingTime.Sub(startingTime)
                
                log.Printf( "Processing Time in Milliseconds [%v]", duration )
                log.Println(postback)
            case <- quit:
                ticker.Stop()
                return
        }
    }
}