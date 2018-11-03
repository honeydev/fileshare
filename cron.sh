#!/bin/bash

crontab -l > cron_backup
cp cron_backup tasks
# clear old files every 30 minutes
echo "30 * * * * $PWD/run_tasks.php -t cleanFiles >> $PWD/cron.log 2>&1" >> tasks
crontab tasks
rm tasks