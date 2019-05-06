export PATH="$(echo "$PATH" | sed -r -e 's;:/mnt/[^:]+;;g')"
