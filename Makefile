INSTALL_DIR := $(HOME)/.local/bin
GLOBAL_INSTALL_DIR := /usr/local/bin

local: resources/default-app/worker-def.php  
	cp resources/default-app/worker-def.php worker
	chmod +x worker
	cp worker $(INSTALL_DIR)/worker

clean:
	rm -fr worker $(INSTALL_DIR)/worker

global: resources/default-app/worker-def.php  
	cp resources/default-app/worker-def.php worker
	chmod +x worker
	cp worker $(GLOBAL_INSTALL_DIR)/worker

uninstall:
	rm -rf $(GLOBAL_INSTALL_DIR)/worker $(INSTALL_DIR)/worker
