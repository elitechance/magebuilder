#!/bin/sh
mbd.sh check-class $1 $2 | xargs bash -c '< /dev/tty vim "$@"' ignore-first-arg

