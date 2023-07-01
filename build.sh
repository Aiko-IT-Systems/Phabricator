#!/bin/bash
git pull && ../arcanist/bin/arc liberate src/ && ./bin/celerity map && ./bin/phd restart && service apache2 restart
