#!/bin/bash

cd ..

# Deletes everything from the crontab. (From the current user)
crontab -r

# Writes the current crontab to a file. 
crontab -l > tempfile

# Each task to run has to be defined through a single line
# indicating with different fields when the task will be run
# and what command to run for the task
#
# To define the time you can provide concrete values for
# minute (m), hour (h), day of month (dom), month (mon),
# and day of week (dow) or use '*' in these fields (for 'any').#
# Notice that tasks will be started based on the cron's system
# daemon's notion of time and timezones.
#
# Output of the crontab jobs (including errors) is sent through
# email to the user the crontab file belongs to (unless redirected).
#
# For example, you can run a backup of all your user accounts
# at 5 a.m every week with:
# 0 5 * * 1 tar -zcf /var/backups/home.tgz /home/
#
# For more information see the manual pages of crontab(5) and cron(8)
#
# m h  dom mon dow   command
# This Cron will call the Laravel command scheduler every minute. 
# When the schedule:run command is executed, Laravel will evaluate 
# your scheduled tasks and runs the tasks that are due.
# Echos the new job to add to the crontab.
echo "* * * * * sudo docker-compose run --rm artisan schedule:run >> /dev/null 2>&1" >> tempfile
# >> /dev/null 2>&1 = This redirects the standard output to null. So the output is discarded.

# Installs the temp file into the crontab.
crontab tempfile

# Deletes the temp file.
rm tempfile