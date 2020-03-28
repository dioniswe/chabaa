#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE}

if [ "$role" = "queue" ]; then

    echo "Running the queue..."
    php artisan queue:listen --verbose --tries=3
fi