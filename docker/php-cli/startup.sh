#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE}

if [ "$role" = "queue" ]; then

    echo "Running the queue..."
    php /var/www/chabaa/artisan queue:listen --verbose --tries=3
elif [ "$role" = "chabaa" ]; then

echo "start php fpm";
    exec php-fpm
fi