mode-deployment:
	if [ "`cat .build_mode`" != deployment ]; then \
		echo deployment > .build_mode; \
	fi
	make general

mode-development:
	if [ "`cat .build_mode`" != development ]; then \
		echo development > .build_mode; \
	fi
	make general

general: site.prog/siteconf.php
site.prog/siteconf.php: .build_mode lib/siteconf-generator lib/siteconf.tpl.php
	mkdir -p site.prog
	lib/siteconf-generator "`cat .build_mode`" > site.prog/siteconf.php

.PHONY: mode-deployment mode-development general
