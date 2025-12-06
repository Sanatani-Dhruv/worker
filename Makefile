INSTALL_DIR := $(HOME)/.local/bin

install: worker.php
	cp worker.php worker
	chmod +x worker
	cp worker $(INSTALL_DIR)/worker

clean:
	rm -fr worker $(INSTALL_DIR)/blah
