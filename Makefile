DIST=.dist
PLUGIN_NAME=$(shell basename `pwd`)
SOURCE=./*
TARGET=../target
DESTINATION=/var/projets/git/dotclear/plugins/$(PLUGIN_NAME)/
RSYNC=rsync -vrpcC --exclude-from=rsync_exclude

rsync:
	$(RSYNC) $(SOURCE) $(DESTINATION) -n

install:
	$(RSYNC) $(SOURCE) $(DESTINATION)

config: clean manifest
	mkdir -p $(DIST)/$(PLUGIN_NAME)
	cp -pr _*.php BUGS CHANGELOG.md css imgs inc index.php \
	js tpl locales MANIFEST README.md COPYING $(DIST)/$(PLUGIN_NAME)/
	find $(DIST) -name '*~' -exec rm \{\} \;

dist: config
	cd $(DIST); \
	mkdir -p $(TARGET); \
	zip -v -r9 $(TARGET)/plugin-$(PLUGIN_NAME)-$$(grep '/* Version' $(PLUGIN_NAME)/_define.php| cut -d"'" -f2).zip $(PLUGIN_NAME); \
	cd ..

manifest:
	@find ./ -type f|egrep -v '(*~|.git|.gitignore|.dist|target|modele|Makefile|rsync_exclude)'|sed -e 's/\.\///' -e 's/\(.*\)/$(PLUGIN_NAME)\/&/'> ./MANIFEST

clean:
	rm -fr $(DIST)

dist-clean:
	rm -fr $(DESTINATION)


PACK_JS=/home/nicolas/scripts/min.php
PACK_CSS=/home/nicolas/scripts/min_css.php

pack:
	find $(SOURCE) -name '*.min.js' -exec rm \{\} \;
	find $(SOURCE) -name '*.min.css' -exec rm \{\} \;

	find $(SOURCE) -name '*.js' -exec $(PACK_JS) \{\} \;
	find $(SOURCE) -name '*.css' -exec $(PACK_CSS) \{\} '' \;
