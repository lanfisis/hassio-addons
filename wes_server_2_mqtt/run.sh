#!/usr/bin/env bashio

function export_json_to_env () {
    INPUT_FILE="${1}"
    while IFS=$'\t\n' read -r LINE; do
        export "${LINE}"
    done < <(
        <"${INPUT_FILE}" jq \
            --compact-output \
            --raw-output \
            --monochrome-output \
            --from-file \
            <(echo 'to_entries | map("\(.key|ascii_upcase)=\(.value)") | .[]')
    )
}

export_json_to_env "/data/options.json"

symfony server:start -d --port=8282 --dir=app --allow-http --no-tls

symfony php ./app/run/server.php
