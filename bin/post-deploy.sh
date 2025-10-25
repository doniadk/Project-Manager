#!/bin/bash
set -e

# ----------------------------------------
# CakePHP Post-Deploy Script for Render
# ----------------------------------------

echo "Starting post-deploy tasks..."

# 1. Ensure tmp and logs directories exist and are writable
mkdir -p tmp logs
chown -R www-data:www-data tmp logs
chmod -R 775 tmp logs

# 2. Run CakePHP migrations (if migrations exist)
if [ -f bin/cake ]; then
    echo "Running database migrations..."
    bin/cake migrations migrate
else
    echo "CakePHP CLI not found, skipping migrations."
fi

echo "Post-deploy tasks completed successfully!"
