#!/bin/sh

# This script will run all integration tests defined in the
# $pathToIntegrationTestDirectory.

pathToIntegrationTestDirectory="examples"

printTextWithBackgroundColor()
{
    echo
    printf "%b%b%b%s%b" "\033[0m" "\033[48;5;${2}m" "\033[38;5;0m" " ${1} " "\033[0m"
    echo
}

for file in "$pathToIntegrationTestDirectory"/*.php; do
    if [ -f "$file" ]; then
        printTextWithBackgroundColor "Running ${file}" 5
        php "$file"
        echo
        echo
    fi
done

