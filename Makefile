config:
	cp config-default config

siteroot:
	$(MAKE) update-siteroot

update-siteroot:
	if ! [ -e modules/conf ] || \
	   ! [ -e modules/data ] || \
	   ! [ -e modules/lib ]; then\
		$(MAKE) update-data; \
	fi
	dev/install-module base `find modules -maxdepth 1 -mindepth 1 -type d`

update-data:
	-mkdir modules
	cd modules && ../dev/get-file \
		share/tar/conf.tar.xz \
		share/tar/data.tar.xz \
		share/tar/lib.tar.xz
	-rm -rf modules/data modules/lib
	cd modules && xz -cd data.tar.xz | tar x
	cd modules && xz -cd lib.tar.xz | tar x
	if ! [ -e modules/conf ]; then \
		cd modules && xz -cd conf.tar.xz | tar x; \
	fi

.PHONY: update-siteroot update-data
