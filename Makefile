DATESTRING=$(shell date -u '+%Y%m%d%H%M')

config:
	cp config-default config

siteroot:
	$(MAKE) update-siteroot

update-siteroot:
	if ! [ -e modules/conf ] || \
	   ! [ -e modules/data ] || \
	   ! [ -e modules/lib ]; then \
		$(MAKE) update-data; \
	fi
ifeq ($(PURPOSE),development)
	dev/install-module -p development \
		base `find modules -maxdepth 1 -mindepth 1 -type d`
else
	dev/install-module base `find modules -maxdepth 1 -mindepth 1 -type d`
endif

update-siteroot-development:
	PURPOSE=development $(MAKE) update-siteroot

clean-siteroot:
	rm -rf siteroot

update-data: config
	-mkdir modules
	cd modules && ../dev/get-file \
		share/tar/cur/conf.tar.xz \
		share/tar/cur/data.tar.xz \
		share/tar/cur/lib.tar.xz
	-rm -rf modules/data modules/lib
	cd modules && xz -cd data.tar.xz | tar x
	cd modules && xz -cd lib.tar.xz | tar x
	if ! [ -e modules/conf ]; then \
		cd modules && xz -cd conf.tar.xz | tar x; \
	fi

pack-data:
	find    modules/conf \
		modules/data \
		modules/lib \
		    -name '.DS_Store' \
		-or -name '.*.swp' \
		-or -name '*~' \
		-or -name '*.bak' \
		-exec rm \{\} +
	mkdir tar/$(DATESTRING)
	(cd modules; tar -c conf) | xz > tar/$(DATESTRING)/conf.tar.xz
	(cd modules; tar -c data) | xz > tar/$(DATESTRING)/data.tar.xz
	(cd modules; tar -c lib) | xz > tar/$(DATESTRING)/lib.tar.xz

.PHONY: update-siteroot update-data pack-data update-siteroot-development
