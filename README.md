# Kochava
Test project

Complete the following steps to test the project:

1) SSH into the server.
2) Navigate to /root/work/src/worker
3) Start the service by
    #sudo $GOPATH/bin/worker
4) Open a browser and navigate to
    http://159.203.161.89/ingest.php

The form fields have default values which can be changed. To send a job request, change the form fields, and / or press the "Send Request" button. Continually, pressing this button will enter new job requests into the Redis server.

The go service is set with a poll duration of every 5 seconds. When triggered, it will pull the last job in the queue, FIFO and process it. you will see the information logged to the terminal as it processing the job.

Once all jobs have been processed, it will continue polling. When it finds a new job, it will pull it and process it.

To stop the go service, type ctl + c in the terminal.
