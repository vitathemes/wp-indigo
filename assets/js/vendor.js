/**
 * (c) Vjacheslav Trushkin <cyberalien@gmail.com>
 *
 * For the full copyright and license information, please view the license.txt or license.gpl.txt
 * files at https://github.com/iconify/iconify
 *
 * Licensed under Apache 2.0 or GPL 2.0 at your option.
 * If derivative product is not compatible with one of licenses, you can pick one of licenses.
 *
 * @license Apache 2.0
 * @license GPL 2.0
 */
"use strict";

if (self.Iconify === void 0) {
  self.Iconify = {
    isReady: false,
  };

  // Legacy support: keep SimpleSVG variable
  self.SimpleSVG = self.Iconify;

  (function (Iconify, global) {
    var local = {
      config: {},
      version: "1.0.7",
    };

    /**
     * Function to fire custom event and IE9 polyfill
     */
    (function (local) {
      /**
       * CustomEvent polyfill for IE9
       * From https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
       */
      (function () {
        if (typeof window.CustomEvent === "function") return false;

        function CustomEvent(event, params) {
          var evt;

          params = params || { bubbles: false, cancelable: false, detail: void 0 };
          evt = document.createEvent("CustomEvent");
          evt.initCustomEvent(
            event,
            params.bubbles,
            params.cancelable,
            params.detail
          );

          return evt;
        }

        CustomEvent.prototype = window.Event.prototype;
        window.CustomEvent = CustomEvent;
      })();

      /**
       * Dispatch custom event
       *
       * @param {string} name Event name
       * @param {object} [params] Event parameters
       */
      local.event = function (name, params) {
        document.dispatchEvent(new CustomEvent(name, params));
      };
    })(local);

    /**
     * Check if DOM is ready, fire stuff when it is
     */
    (function (Iconify, local, config) {
      /**
       * Timer for initTimeout()
       *
       * @type {*}
       */
      var timer = null;

      /**
       * DOM is ready. Initialize stuff
       */
      local.DOMReadyCallback = function () {
        local.domready = true;
        local.nextInitItem();
      };

      /**
       * Remove event listeners and call DOMReady()
       */
      function DOMLoaded() {
        document.removeEventListener("DOMContentLoaded", DOMLoaded);
        window.removeEventListener("load", DOMLoaded);
        local.DOMReadyCallback();
      }

      /**
       * Function to create timer for init callback
       *
       * @param callback
       */
      local.initTimeout = function (callback) {
        function nextTick() {
          if (timer === null) {
            return;
          }
          if (timer.callback() !== false) {
            timer.stop();
            local.nextInitItem();
            return;
          }
          timer.counter++;

          if (timer.counter === 10 || timer.counter === 25) {
            // Increase timer to reduce page load
            window.clearInterval(timer.id);
            timer.id = window.setInterval(
              nextTick,
              timer.counter === 10 ? 250 : 1000
            );
          }
        }

        if (timer !== null) {
          timer.stop();
        }

        timer = {
          id: window.setInterval(nextTick, 100),
          counter: 0,
          callback: callback,
          stop: function () {
            window.clearInterval(timer.id);
            timer = null;
          },
          nextTick: nextTick,
        };
      };

      /**
       * State of DOM
       *
       * @type {boolean}
       */
      local.domready = false;

      /**
       * State of ready (DOM is ready, initialized)
       *
       * @type {boolean}
       */
      local.ready = false;

      /**
       * List of callbacks to call when Iconify is initializing
       * Callback should return boolean: true if its ready and next event should be called, false if not ready
       * If function returns false, it should call local.nextInitItem when its done
       *
       * @type {[Function]}
       */
      local.initQueue = [];

      /**
       * List of callbacks to call when DOM is ready and initialization has been finished
       * Callback should return boolean: true if its ready and next event should be called, false if not ready
       * If function returns false, it should call local.nextInitItem when its done
       *
       * @type {[Function]}
       */
      local.readyQueue = [];

      /**
       * Check init queue, do next step
       */
      local.nextInitItem = function () {
        var callback;

        if (local.ready) {
          return;
        }

        if (local.initQueue.length) {
          callback = local.initQueue.shift();
        } else {
          if (!local.domready) {
            // Init queue is done. Scan DOM on timer to refresh icons during load
            local.initTimeout(function () {
              if (!local.domready && document.body) {
                local.scanDOM();
              }
              return local.domready;
            });

            return;
          }

          if (local.readyQueue.length) {
            callback = local.readyQueue.shift();
          } else {
            local.ready = Iconify.isReady = true;
            local.event(config._readyEvent);
            local.scanDOM();
            return;
          }
        }

        if (callback() !== false) {
          local.nextInitItem();
        }
      };

      /**
       * Add stylesheet
       *
       * @param timed
       * @returns {boolean}
       */
      local.addStylesheet = function (timed) {
        var el;

        if (!document.head || !document.body) {
          if (local.domready) {
            // head or body is missing, but document is ready? weird
            return true;
          }
          if (!timed) {
            local.initTimeout(local.addStylesheet.bind(null, true));
          }
          return false;
        }

        // Add Iconify stylesheet
        try {
          el = document.createElement("style");
          el.type = "text/css";
          el.innerHTML =
            "span.iconify, i.iconify, iconify-icon { display: inline-block; width: 1em; }";
          if (document.head.firstChild !== null) {
            document.head.insertBefore(el, document.head.firstChild);
          } else {
            document.head.appendChild(el);
          }
        } catch (err) {}

        return true;
      };
      local.initQueue.push(local.addStylesheet.bind(null, false));

      /**
       * Events to run when Iconify is ready
       *
       * @param {function} callback
       */
      Iconify.ready = function (callback) {
        if (Iconify.isReady) {
          window.setTimeout(callback);
        } else {
          document.addEventListener(config._readyEvent, callback);
        }
      };

      // Do stuff on next tick after script has loaded
      window.setTimeout(function () {
        // Check for DOM ready state
        if (
          document.readyState === "complete" ||
          (document.readyState !== "loading" && !document.documentElement.doScroll)
        ) {
          local.domready = true;
        } else {
          document.addEventListener("DOMContentLoaded", DOMLoaded);
          window.addEventListener("load", DOMLoaded);
        }
        local.nextInitItem();
      });
    })(Iconify, local, local.config);

    /**
     * Default configuration.
     * Configuration variables that cannot be changed after script has loaded start with _
     *
     * Additional defaults.js are included in sub-directories, with different content for different builds
     */
    (function (config) {
      // Custom default attributes for SVG
      config.SVGAttributes = Object.create(null);

      // Class name for icons
      config._imageClass = "iconify";

      // Class name for image that is being loaded
      config._loadingClass = "svg-loading";

      // Attribute that stores icon name
      config._iconAttribute = "data-icon";

      // Attribute for rotation
      config._rotateAttribute = "data-rotate";

      // Attribute for flip
      config._flipAttribute = "data-flip";

      // Attribute for inline mode
      config._inlineModeAttribute = "data-inline";

      // Attribute for alignment
      config._alignAttribute = "data-align";

      // Attribute to append icon to element instead of replacing element
      config._appendAttribute = "data-icon-append";

      // Class to add to container when content has been appended
      config._appendedClass = "svg-appended";

      // Event to call when Iconify is ready
      config._readyEvent = "IconifyReady";

      // Polyfill URLs
      config._webComponentsPolyfill =
        "https://cdnjs.cloudflare.com/ajax/libs/webcomponentsjs/0.7.24/webcomponents-lite.min.js";
      config._classListPolyfill =
        "https://cdnjs.cloudflare.com/ajax/libs/classlist/1.1.20150312/classList.min.js";
    })(local.config);

    /**
     * Default configuration when API module is included
     */
    (function (config) {
      // API callback script
      config.defaultAPI = "https://api.iconify.design/{prefix}.js?icons={icons}";

      // Custom API list. Key = prefix, value = API URL
      config.API = Object.create(null);

      // Maximum length of API URL
      config.loaderMaxURLSize = 500;

      // True if icons should be loaded before DOM is ready
      // Disable this option is you are pre-loading any icons and script is in <head> section
      // Default value: enabled if script is in <head> section, disabled if script is in <body> section
      config.loadBeforeDOMReady = !(document && document.body);

      // Custom event to call after new set of images was added
      config._loaderEvent = "IconifyAddedIcons";

      // True if session storage should be used to cache icons between different pages to minimize number of API calls.
      // If localStorage is enabled, icons will be saved to localStorage instead of sessionStorage.
      config.sessionStorage = true;

      // True if local storage should be used to cache icons. This option might require cookie confirmation in some countries,
      // so it is disabled unless storage already has some data, which means website is using it, so script assumes user
      // has accepted cookies.
      try {
        config.localStorage = !!(
          window &&
          window.localStorage &&
          window.localStorage.length
        );
      } catch (err) {
        config.localStorage = false;
      }
    })(local.config);

    /**
     * Merge custom and default configuration and functions for changing config values
     *
     * It will merge default config with IconifyConfig object if it exists, allowing to set
     * configuration before including Iconify script (useful if Iconify is loaded asynchronously).
     */
    (function (Iconify, global, local, config) {
      /**
       * Change config value
       *
       * @param {string} key
       * @param {*} value
       * @param {boolean} canChangeHardcoded
       */
      function setConfig(key, value, canChangeHardcoded) {
        var configKey = key;

        if (key.slice(0, 1) === "_") {
          return;
        }

        if (config[key] === void 0) {
          if (!canChangeHardcoded || config["_" + key] === void 0) {
            return;
          }
          configKey = "_" + key;
        }

        switch (configKey) {
          case "API":
          case "SVGAttributes":
            // Merge objects
            Object.keys(value).forEach(function (key2) {
              if (value[key] === null) {
                delete config[configKey][key2];
              } else {
                config[configKey][key2] = value[key2];
              }
            });
            break;

          default:
            // Overwrite config
            config[configKey] = value;
        }
      }

      /**
       * Change configuration option
       *
       * @param {string} name
       * @param {*} value
       */
      Iconify.setConfig = function (name, value) {
        setConfig(name, value, false);
      };

      /**
       * Set custom API URL
       *
       * @param {string|Array} prefix Collection prefix
       * @param {string} url API JSONP URL. There are several possible variables in URL:
       *
       *	  {icons} represents icons list
       *	  {callback} represents Iconify callback function
       *	  {prefix} is replaced with collection prefix (used when multiple collections are added with same url)
       *
       *	  All variables are optional. If {icons} is missing, callback must return entire collection.
       */
      Iconify.setCustomAPI = function (prefix, url) {
        var keys;

        // noinspection FallThroughInSwitchStatementJS
        switch (typeof prefix) {
          case "string":
            keys = [prefix];
            break;

          case "object":
            if (prefix instanceof Array) {
              keys = prefix;
              break;
            }

          default:
            return;
        }
        prefix.forEach(function (key) {
          if (url === null) {
            delete config.API[key];
          } else {
            config.API[key] = url;
          }
        });
      };

      /**
       * Get configuration value
       *
       * @param {string} name
       * @return {*}
       */
      Iconify.getConfig = function (name) {
        return config[name] === void 0
          ? config["_" + name] === void 0
            ? null
            : config["_" + name]
          : config[name];
      };

      // Merge configuration with SimpleSVGConfig (for backwards compatibility) and IconifyConfig objects
      // TODO: remove backwards compatibility with old beta before final release
      ["SimpleSVG", "Iconify"].forEach(function (prefix) {
        var obj;
        if (
          global[prefix + "Config"] !== void 0 &&
          typeof global[prefix + "Config"] === "object"
        ) {
          obj = global[prefix + "Config"];
          Object.keys(obj).forEach(function (key) {
            setConfig(key, obj[key], true);
          });
        }
      });
    })(Iconify, global, local, local.config);

    /**
     * Observer polyfill loader
     */
    (function (local, config, global) {
      /**
       * Add to init queue
       */
      local.initQueue.push(function () {
        var loading = {
          observer: false,
          classList: false,
        };

        var queued = {
          observer: false,
          classList: false,
        };

        /**
         * Load script
         *
         * @param {string} url
         * @returns {boolean} True if script has been added to head
         */
        function load(url) {
          var element;

          if (!url.length) {
            // Assume some other functions will load polyfill
            return true;
          }

          if (!document.head) {
            // local.domready should be equal false. if its true, something went wrong
            return local.domready;
          }

          element = document.createElement("script");
          element.setAttribute("src", url);
          element.setAttribute("type", "text/javascript");
          document.head.appendChild(element);

          return true;
        }

        /**
         * Test if classList is supported
         *
         * @returns {boolean}
         */
        function testClassList() {
          if (!("classList" in document.createElement("div"))) {
            if (!queued.classList) {
              queued.classList = load(config._classListPolyfill);
            }
            return false;
          }
          return true;
        }

        /**
         * Test is MutationObserver is supported
         *
         * @returns {boolean}
         */
        function testObserver() {
          if (!global.MutationObserver || !global.WeakMap) {
            if (!queued.observer) {
              queued.observer = load(config._webComponentsPolyfill);
            }
          }
          return true;
        }

        loading.classList = !testClassList();
        loading.observer = !testObserver();

        if (loading.classList || loading.observer) {
          local.initTimeout(function () {
            return !(
              (loading.observer && !testObserver()) ||
              (loading.classList && !testClassList())
            );
          });
          return false;
        }
        return true;
      });
    })(local, local.config, global);

    (function () {
      /**
       * Find prefix for icon
       *
       * @param {string} icon Icon name
       * @param {string} [prefix] Collection prefix
       * @returns {{prefix, icon}}
       */
      function getPrefix(icon, prefix) {
        var split;

        if (typeof prefix === "string" && prefix !== "") {
          return {
            prefix: prefix,
            icon: icon,
          };
        }

        // Check for fa-pro:home
        split = icon.split(":");
        if (split.length === 2) {
          return {
            prefix: split[0],
            icon: split[1],
          };
        }

        // Check for fa-home
        split = icon.split("-");
        if (split.length > 1) {
          prefix = split.shift();
          return {
            prefix: prefix,
            icon: split.join("-"),
          };
        }

        return {
          prefix: "",
          icon: icon,
        };
      }

      local.getPrefix = getPrefix;
    })();

    (function () {
      var getPrefix = local.getPrefix;

      /**
       * Default values for attributes
       *
       * @type {object}
       */
      var itemDefaults = {
        left: 0,
        top: 0,
        width: 16,
        height: 16,
        rotate: 0,
        vFlip: false,
        hFlip: false,
      };

      /**
       * List of attributes to check
       *
       * @type {[string]}
       */
      var itemAttributes = [
        // Dimensions
        "left",
        "top",
        "width",
        "height",
        // Content
        "body",
        // Transformations
        "rotate",
        "vFlip",
        "hFlip",
        // Inline mode data
        "inlineTop",
        "inlineHeight",
        "verticalAlign",
      ];

      /**
       * Convert value to appropriate type
       *
       * @param {string} attr Attribute name
       * @param {*} value Value
       * @return {*}
       */
      function normalizeValue(attr, value) {
        switch (attr) {
          case "rotate":
            value = parseInt(value);
            if (isNaN(value)) {
              return null;
            }
            return value;

          case "width":
          case "height":
          case "inlineHeight":
          case "inlineTop":
          case "verticalAlign":
            value = parseFloat(value);
            return isNaN(value) ? null : value;

          case "vFlip":
          case "hFlip":
            return !!value;

          case "body":
          case "parent":
            return typeof value === "string" ? value : null;
        }
        return value;
      }

      /**
       * Merge and normalize rotate values
       *
       * @param value1
       * @param value2
       * @return {*}
       */
      function mergeRotation(value1, value2) {
        return normalizeValue("rotate", value1 + value2);
      }

      /**
       * Merge and normalize flip values
       *
       * @param value1
       * @param value2
       * @return {boolean}
       */
      function mergeFlip(value1, value2) {
        return !!value1 !== !!value2;
      }

      /**
       * Assign default values to item
       *
       * @param {object} item
       * @returns {object}
       */
      function setDefaults(item) {
        var result = Object.create(null);

        (item._defaults === void 0
          ? [item, itemDefaults]
          : [item, item._defaults, itemDefaults]
        ).forEach(function (values) {
          Object.keys(values).forEach(function (attr) {
            if (typeof values[attr] !== "object" && result[attr] === void 0) {
              result[attr] = values[attr];
            }
          });
        });

        if (result.inlineTop === void 0) {
          result.inlineTop = result.top;
        }
        if (result.inlineHeight === void 0) {
          result.inlineHeight = result.height;
        }
        if (result.verticalAlign === void 0) {
          if (result.height % 7 === 0 && result.height % 8 !== 0) {
            // Icons designed for 14px height
            result.verticalAlign = -0.143;
          } else {
            // Assume icon is designed for 16px height
            result.verticalAlign = -0.125;
          }
        }

        return result;
      }

      /**
       * Returns new instance of storage object
       *
       * @return {object}
       * @constructor
       */
      function Storage() {
        // Raw data
        this._icons = Object.create(null);
        this._aliases = Object.create(null);

        // Normalized data (both icons and aliases). false = pending, null = cannot be resolved, object = resolved
        this._resolved = Object.create(null);

        /**
         * Add icon or alias to storage
         *
         * @param {boolean} alias
         * @param {object} icon
         * @param {object} data
         * @private
         */
        this._add = function (alias, icon, data) {
          var key = alias ? "_aliases" : "_icons";

          if (this._resolved[icon.prefix] === void 0) {
            // Add resolved object to mark prefix as usable
            this._resolved[icon.prefix] = Object.create(null);
            this._icons[icon.prefix] = Object.create(null);
            this._aliases[icon.prefix] = Object.create(null);
          } else {
            // Delete old item with same name
            delete this._icons[icon.prefix][icon.icon];
            delete this._aliases[icon.prefix][icon.icon];
          }

          // Mark that item exists for quick lookup
          this._resolved[icon.prefix][icon.icon] = false;
          this[key][icon.prefix][icon.icon] = data;
        };

        /**
         * Resolve icon
         *
         * @param {object} icon
         * @returns {object|null}
         * @private
         */
        this._resolveIcon = function (icon) {
          var item, counter, result, parentIcon, isAlias, parent;

          // Check if icon exists
          if (
            this._resolved[icon.prefix] === void 0 ||
            this._resolved[icon.prefix][icon.icon] === void 0
          ) {
            return null;
          }

          // Already resolved?
          if (this._resolved[icon.prefix][icon.icon] !== false) {
            return this._resolved[icon.prefix][icon.icon];
          }

          // Icon - set defaults, store resolved value, return
          if (this._icons[icon.prefix][icon.icon] !== void 0) {
            return (this._resolved[icon.prefix][icon.icon] = setDefaults(
              this._icons[icon.prefix][icon.icon]
            ));
          }

          // Resolve alias
          counter = 0;
          item = this._aliases[icon.prefix][icon.icon];
          result = Object.create(null);
          Object.keys(item).forEach(function (attr) {
            if (attr !== "parent") {
              result[attr] = item[attr];
            }
          });
          parentIcon = item.parent;

          while (true) {
            counter++;
            if (counter > 5 || this._resolved[icon.prefix][parentIcon] === void 0) {
              return (this._resolved[icon.prefix][icon.icon] = null);
            }

            isAlias = this._icons[icon.prefix][parentIcon] === void 0;
            parent = this[isAlias ? "_aliases" : "_icons"][icon.prefix][parentIcon];

            // Merge data
            Object.keys(parent).forEach(function (attr) {
              if (result[attr] === void 0) {
                if (attr !== "parent") {
                  result[attr] = parent[attr];
                }
                return;
              }
              switch (attr) {
                case "rotate":
                  result[attr] = mergeRotation(result[attr], parent[attr]);
                  break;

                case "hFlip":
                case "vFlip":
                  result[attr] = mergeFlip(result[attr], parent[attr]);
              }
            });

            if (!isAlias) {
              break;
            }
            parentIcon = parent.parent;
          }

          return (this._resolved[icon.prefix][icon.icon] = setDefaults(result));
        };

        /**
         * Function to add collection
         *
         * @param {object} json JSON data
         */
        this.addCollection = function (json) {
          // Get default values
          var that = this,
            defaults = Object.create(null);

          // Get default values for icons
          itemAttributes.forEach(function (attr) {
            if (json[attr] !== void 0) {
              defaults[attr] = json[attr];
            } else if (itemDefaults[attr] !== void 0) {
              defaults[attr] = itemDefaults[attr];
            }
          });

          // Parse icons
          if (json.icons !== void 0) {
            Object.keys(json.icons).forEach(function (key) {
              var icon = getPrefix(key, json.prefix),
                item = json.icons[key];
              if (item.body === void 0) {
                return;
              }
              item._defaults = defaults;
              that._add(false, icon, item);
            });
          }

          // Parse aliases
          if (json.aliases !== void 0) {
            Object.keys(json.aliases).forEach(function (key) {
              var icon = getPrefix(key, json.prefix),
                item = json.aliases[key];
              if (item.parent === void 0) {
                return;
              }
              if (json.prefix === void 0) {
                // Remove prefix from parent item
                if (item.parent.slice(0, icon.prefix.length) !== icon.prefix) {
                  return;
                }
                item.parent = item.parent.slice(icon.prefix.length + 1);
              }
              that._add(true, icon, item);
            });
          }
        };

        /**
         * Add icon
         *
         * @param {string} name Icon name
         * @param {object} data Icon data
         * @param {string} [prefix] Icon prefix
         */
        this.addIcon = function (name, data, prefix) {
          var alias = data.parent !== void 0,
            icon = getPrefix(name, prefix);

          if (alias && prefix === void 0) {
            // Remove prefix from parent item
            if (data.parent.slice(0, icon.prefix.length) !== icon.prefix) {
              return;
            }
            data.parent = data.parent.slice(icon.prefix.length + 1);
          }

          this._add(alias, icon, data);
        };

        /**
         * Check if icon exists
         *
         * @param {string} name Icon name
         * @param {string} [prefix] Icon prefix. If prefix is set, name should not include prefix
         * @return {boolean}
         */
        this.exists = function (name, prefix) {
          var icon = getPrefix(name, prefix);

          return (
            this._resolved[icon.prefix] !== void 0 &&
            this._resolved[icon.prefix][icon.icon] !== void 0
          );
        };

        /**
         * Get item data as object reference (changing it will change original object)
         *
         * @param {string} name Icon name
         * @param {string} [prefix] Optional icon prefix
         * @return {object|null}
         */
        this.getIcon = function (name, prefix) {
          var icon = getPrefix(name, prefix);

          return this._resolveIcon(icon);
        };

        /**
         * Get item data as copy of object
         *
         * @param {string} name Icon name
         * @param {string} [prefix] Optional icon prefix
         * @return {object|null}
         */
        this.copyIcon = function (name, prefix) {
          var item = this.getIcon(name, prefix),
            result;

          if (item === null) {
            return null;
          }

          result = Object.create(null);
          Object.keys(item).forEach(function (attr) {
            result[attr] = item[attr];
          });

          return result;
        };

        /**
         * Get list of available items
         *
         * @param {string} [prefix] Optional prefix
         * @return {Array}
         */
        this.list = function (prefix) {
          var results, items;

          if (prefix !== void 0) {
            return this._resolved[prefix] === void 0
              ? []
              : Object.keys(this._resolved[prefix]);
          }

          results = [];
          items = this._resolved;
          Object.keys(items).forEach(function (prefix) {
            results = results.concat(
              Object.keys(items[prefix]).map(function (key) {
                return prefix === "" && key.indexOf("-") === -1
                  ? key
                  : prefix + ":" + key;
              })
            );
          });
          return results;
        };

        return this;
      }

      Storage.mergeFlip = mergeFlip;
      Storage.mergeRotation = mergeRotation;
      Storage.blankIcon = function () {
        var item = {
          body: "",
          width: 16,
          height: 16,
        };
        return setDefaults(item);
      };

      local.Storage = Storage;
    })();

    /**
     * Icons storage handler
     */
    (function (Iconify, local, global) {
      var eventQueued = false,
        storage = new local.Storage();

      /**
       * Triggers callback
       */
      function triggerCallback() {
        if (!eventQueued) {
          return;
        }
        eventQueued = false;
        local.scanDOM();
      }

      /**
       * Function to add collection
       *
       * @param {object} json JSON data
       * @param {boolean} [doNotScan] If true, DOM scan will not be triggered
       */
      Iconify.addCollection = function (json, doNotScan) {
        storage.addCollection(json);
        if (!eventQueued && doNotScan !== true) {
          eventQueued = true;
          window.setTimeout(triggerCallback, 0);
        }
      };

      /**
       * Add icon
       *
       * @param {string} name Icon name
       * @param {object} data Icon data
       * @param {boolean} [doNotScan] If true, DOM scan will not be triggered
       */
      Iconify.addIcon = function (name, data, doNotScan) {
        storage.addIcon(name, data);
        if (!eventQueued && doNotScan !== true) {
          eventQueued = true;
          window.setTimeout(triggerCallback, 0);
        }
      };

      /**
       * Check if icon exists
       *
       * @param {string} name Icon name
       * @param {string} [prefix] Optional icon prefix (if prefix is set name should not include prefix)
       * @return {boolean}
       */
      Iconify.iconExists = storage.exists.bind(storage);

      /**
       * Get icon data
       *
       * @param {string} name Icon name
       * @param {string} [prefix] Optional icon prefix (if prefix is set name should not include prefix)
       * @return {null}
       */
      Iconify.getIcon = storage.copyIcon.bind(storage);

      /**
       * Get list of available icons
       *
       * @param {string} prefix If prefix is set, only icons with that prefix will be listed
       * @return {Array}
       */
      Iconify.listIcons = storage.list.bind(storage);

      /**
       * Add collections from global IconifyPreload array
       *
       * This allows preloading icons before including Iconify
       * To preload icons before and after Iconify, instead of wrapping object in
       *  Iconify.addCollection(data);
       * use this:
       *  (window.Iconify ? window.Iconify.addCollection : ((window.IconifyPreload = window.IconifyPreload || []).push.bind(window.IconifyPreload)))(data);
       *
       * TODO: remove backwards compatibility with old beta before final release
       */
      ["SimpleSVG", "Iconify"].forEach(function (prefix) {
        if (
          global[prefix + "Preload"] !== void 0 &&
          global[prefix + "Preload"] instanceof Array
        ) {
          global[prefix + "Preload"].forEach(function (item) {
            if (typeof item === "object" && item.icons !== void 0) {
              Iconify.addCollection(item);
            }
          });
        }
      });
    })(Iconify, local, global);

    (function () {
      var Storage = local.Storage;
      var config = local.config;

      /**
       * Regular expressions for calculating dimensions
       *
       * @type {RegExp}
       */
      var unitsSplit = /(-?[0-9.]*[0-9]+[0-9.]*)/g,
        unitsTest = /^-?[0-9.]*[0-9]+[0-9.]*$/g;

      /**
       * List of attributes used in generating SVG code that should not be passed to SVG object
       *
       * @type {Array}
       */
      var reservedAttributes = ["width", "height", "inline"];

      /**
       * List of attributes to convert to tags inside SVG
       *
       * @type {string[]}
       */
      var attributesToTags = ["title"];

      /**
       * Unique id counter
       *
       * @type {number}
       */
      var idCounter = 0;

      /**
       * Calculate second dimension when only 1 dimension is set
       *
       * @param {string|number} size One dimension (such as width)
       * @param {number} ratio Width/height ratio.
       *	  If size is width, ratio = height/width
       *	  If size is height, ratio = width/height
       * @param {number} [precision] Floating number precision in result to minimize output. Default = 100
       * @return {string|number} Another dimension
       */
      function calculateDimension(size, ratio, precision) {
        var split, number, results, code, isNumber, num;

        if (ratio === 1) {
          return size;
        }

        precision = precision === void 0 ? 100 : precision;
        if (typeof size === "number") {
          return Math.ceil(size * ratio * precision) / precision;
        }

        if (typeof size !== "string") {
          return size;
        }

        // Split code into sets of strings and numbers
        split = size.split(unitsSplit);
        if (split === null || !split.length) {
          return size;
        }

        results = [];
        code = split.shift();
        isNumber = unitsTest.test(code);

        while (true) {
          if (isNumber) {
            num = parseFloat(code);
            if (isNaN(num)) {
              results.push(code);
            } else {
              results.push(Math.ceil(num * ratio * precision) / precision);
            }
          } else {
            results.push(code);
          }

          // next
          code = split.shift();
          if (code === void 0) {
            return results.join("");
          }
          isNumber = !isNumber;
        }
      }

      /**
       * Replace IDs in SVG output with unique IDs
       * Fast replacement without parsing XML, assuming commonly used patterns.
       *
       * @param body
       * @return {*}
       */
      function replaceIDs(body) {
        var regex = /\sid="(\S+)"/g,
          ids = [],
          match,
          prefix;

        function strReplace(search, replace, subject) {
          var pos = 0;

          while ((pos = subject.indexOf(search, pos)) !== -1) {
            subject =
              subject.slice(0, pos) + replace + subject.slice(pos + search.length);
            pos += replace.length;
          }

          return subject;
        }

        // Find all IDs
        while ((match = regex.exec(body))) {
          ids.push(match[1]);
        }
        if (!ids.length) {
          return body;
        }

        prefix =
          "IconifyId-" +
          Date.now().toString(16) +
          "-" +
          ((Math.random() * 0x1000000) | 0).toString(16) +
          "-";

        // Replace with unique ids
        ids.forEach(function (id) {
          var newID = prefix + idCounter;
          idCounter++;
          body = strReplace('="' + id + '"', '="' + newID + '"', body);
          body = strReplace('="#' + id + '"', '="#' + newID + '"', body);
          body = strReplace("(#" + id + ")", "(#" + newID + ")", body);
        });

        return body;
      }

      /**
       * Get boolean attribute value
       *
       * @param {object} attributes
       * @param {Array} properties
       * @param {*} defaultValue
       * @return {*}
       */
      function getBooleanValue(attributes, properties, defaultValue) {
        var i, prop, value;

        for (i = 0; i < properties.length; i++) {
          prop = properties[i];
          if (attributes[prop] !== void 0) {
            value = attributes[prop];
            switch (typeof value) {
              case "boolean":
                return value;

              case "number":
                return !!value;

              case "string":
                switch (value.toLowerCase()) {
                  case "1":
                  case "true":
                  case prop:
                    return true;

                  case "0":
                  case "false":
                  case "":
                    return false;
                }
            }
          }
        }

        return defaultValue;
      }

      /**
       * Get boolean attribute value
       *
       * @param {object} attributes
       * @param {Array} properties
       * @param {*} defaultValue
       * @return {*}
       */
      function getValue(attributes, properties, defaultValue) {
        var i, prop;

        for (i = 0; i < properties.length; i++) {
          prop = properties[i];
          if (attributes[prop] !== void 0) {
            return attributes[prop];
          }
        }

        return defaultValue;
      }

      /**
       * SVG object constructor
       *
       * @param {object} item Item from storage
       * @return {SVG}
       * @constructor
       */
      function SVG(item) {
        if (!item) {
          // Set empty icon
          item = Storage.blankIcon();
        }

        this.item = item;

        /**
         * Get icon height
         *
         * @param {string|number} [width] Width to calculate height for. If missing, default icon height will be returned.
         * @param {boolean} [inline] Inline mode. If missing, assumed to be false
         * @param {number} [precision] Precision for calculating height. Result is rounded to 1/precision. Default = 100
         * @return {number|null}
         */
        this.height = function (width, inline, precision) {
          if (width === void 0) {
            return inline ? this.item.inlineHeight : this.item.height;
          }
          return calculateDimension(
            width,
            (inline ? this.item.inlineHeight : this.item.height) / this.item.width,
            precision
          );
        };

        /**
         * Get icon width
         *
         * @param {string|number} [height] Height to calculate width for. If missing, default icon width will be returned.
         * @param {boolean} [inline] Inline mode. If missing, assumed to be false
         * @param {number} [precision] Precision for calculating width. Result is rounded to 1/precision. Default = 100
         * @return {number|null}
         */
        this.width = function (height, inline, precision) {
          if (height === void 0) {
            return this.item.width;
          }
          return calculateDimension(
            height,
            this.item.width / (inline ? this.item.inlineHeight : this.item.height),
            precision
          );
        };

        /**
         * Get default SVG attributes
         *
         * @return {object}
         */
        this.defaultAttributes = function () {
          return {
            xmlns: "http://www.w3.org/2000/svg",
            "xmlns:xlink": "http://www.w3.org/1999/xlink",
            "aria-hidden": "true",
            focusable: "false",
          };
        };

        /**
         * Get preserveAspectRatio attribute value
         *
         * @param {*} [horizontal] Horizontal alignment: left, center, right. Default = center
         * @param {*} [vertical] Vertical alignment: top, middle, bottom. Default = middle
         * @param {boolean} [slice] Slice: true or false. Default = false
         * @return {string}
         */
        this.preserveAspectRatio = function (horizontal, vertical, slice) {
          var result = "";
          switch (horizontal) {
            case "left":
              result += "xMin";
              break;

            case "right":
              result += "xMax";
              break;

            default:
              result += "xMid";
          }
          switch (vertical) {
            case "top":
              result += "YMin";
              break;

            case "bottom":
              result += "YMax";
              break;

            default:
              result += "YMid";
          }
          result += slice === true ? " slice" : " meet";
          return result;
        };

        /**
         * Escape HTML
         *
         * @param {*} value
         * @return {string}
         */
        this.htmlspecialchars = function (value) {
          switch (typeof value) {
            case "boolean":
            case "number":
              return value + "";

            case "string":
              return value
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
          }
          return "";
        };

        /**
         * Generate SVG attributes from attributes list
         *
         * @param {object} [attributes] Element attributes
         * @return {object|null}
         */
        this.attributes = function (attributes) {
          var instance = this;

          var align = {
            horizontal: "center",
            vertical: "middle",
            crop: false,
          };

          var transform = {
            rotate: item.rotate,
            hFlip: item.hFlip,
            vFlip: item.vFlip,
          };
          var style = "";
          var result = this.defaultAttributes();

          var box,
            customWidth,
            customHeight,
            width,
            height,
            inline,
            body,
            value,
            split,
            append,
            units,
            extraAttributes,
            verticalAlign;
          var transformations = [],
            tempValue;

          attributes =
            typeof attributes === "object" ? attributes : Object.create(null);

          // Check mode and get dimensions
          inline = getBooleanValue(
            attributes,
            [config._inlineModeAttribute, "inline"],
            true
          );
          append = getBooleanValue(attributes, [config._appendAttribute], false);

          box = {
            left: item.left,
            top: inline ? item.inlineTop : item.top,
            width: item.width,
            height: inline ? item.inlineHeight : item.height,
          };

          // Transformations
          if (typeof attributes[config._flipAttribute] === "string") {
            attributes[config._flipAttribute]
              .split(/[\s,]+/)
              .forEach(function (value) {
                value = value.toLowerCase();
                switch (value) {
                  case "horizontal":
                    transform.hFlip = !transform.hFlip;
                    break;

                  case "vertical":
                    transform.vFlip = !transform.vFlip;
                    break;
                }
              });
          }
          if (attributes[config._rotateAttribute] !== void 0) {
            value = attributes[config._rotateAttribute];
            if (typeof value === "number") {
              transform.rotate += value;
            } else if (typeof value === "string") {
              units = value.replace(/^-?[0-9.]*/, "");
              if (units === "") {
                value = parseInt(value);
                if (!isNaN(value)) {
                  transform.rotate += value;
                }
              } else if (units !== value) {
                split = false;
                switch (units) {
                  case "%":
                    // 25% -> 1, 50% -> 2, ...
                    split = 25;
                    break;

                  case "deg":
                    // 90deg -> 1, 180deg -> 2, ...
                    split = 90;
                }
                if (split) {
                  value = parseInt(value.slice(0, value.length - units.length));
                  if (!isNaN(value)) {
                    transform.rotate += Math.round(value / split);
                  }
                }
              }
            }
          }

          // Apply transformations to box
          if (transform.hFlip) {
            if (transform.vFlip) {
              transform.rotate += 2;
            } else {
              // Horizontal flip
              transformations.push(
                "translate(" + (box.width + box.left) + " " + (0 - box.top) + ")"
              );
              transformations.push("scale(-1 1)");
              box.top = box.left = 0;
            }
          } else if (transform.vFlip) {
            // Vertical flip
            transformations.push(
              "translate(" + (0 - box.left) + " " + (box.height + box.top) + ")"
            );
            transformations.push("scale(1 -1)");
            box.top = box.left = 0;
          }
          switch (transform.rotate % 4) {
            case 1:
              // 90deg
              tempValue = box.height / 2 + box.top;
              transformations.unshift(
                "rotate(90 " + tempValue + " " + tempValue + ")"
              );
              // swap width/height and x/y
              if (box.left !== 0 || box.top !== 0) {
                tempValue = box.left;
                box.left = box.top;
                box.top = tempValue;
              }
              if (box.width !== box.height) {
                tempValue = box.width;
                box.width = box.height;
                box.height = tempValue;
              }
              break;

            case 2:
              // 180deg
              transformations.unshift(
                "rotate(180 " +
                  (box.width / 2 + box.left) +
                  " " +
                  (box.height / 2 + box.top) +
                  ")"
              );
              break;

            case 3:
              // 270deg
              tempValue = box.width / 2 + box.left;
              transformations.unshift(
                "rotate(-90 " + tempValue + " " + tempValue + ")"
              );
              // swap width/height and x/y
              if (box.left !== 0 || box.top !== 0) {
                tempValue = box.left;
                box.left = box.top;
                box.top = tempValue;
              }
              if (box.width !== box.height) {
                tempValue = box.width;
                box.width = box.height;
                box.height = tempValue;
              }
              break;
          }

          // Calculate dimensions
          // Values for width/height: null = default, 'auto' = from svg, false = do not set
          // Default: if both values aren't set, height defaults to '1em', width is calculated from height
          customWidth = getValue(attributes, ["data-width", "width"], null);
          customHeight = getValue(attributes, ["data-height", "height"], null);

          if (customWidth === null && customHeight === null) {
            customHeight = "1em";
          }
          if (customWidth !== null && customHeight !== null) {
            width = customWidth;
            height = customHeight;
          } else if (customWidth !== null) {
            width = customWidth;
            height = calculateDimension(width, box.height / box.width);
          } else {
            height = customHeight;
            width = calculateDimension(height, box.width / box.height);
          }

          if (width !== false) {
            result.width = width === "auto" ? box.width : width;
          }
          if (height !== false) {
            result.height = height === "auto" ? box.height : height;
          }

          // Apply inline mode to offsets
          if (inline && item.verticalAlign !== 0) {
            verticalAlign = item.verticalAlign + "em";
            style += "vertical-align: " + verticalAlign + ";";
          } else {
            verticalAlign = "";
          }

          // Check custom alignment
          if (typeof attributes[config._alignAttribute] === "string") {
            attributes[config._alignAttribute]
              .toLowerCase()
              .split(/[\s,]+/)
              .forEach(function (value) {
                switch (value) {
                  case "left":
                  case "right":
                  case "center":
                    align.horizontal = value;
                    break;

                  case "top":
                  case "bottom":
                  case "middle":
                    align.vertical = value;
                    break;

                  case "crop":
                    align.crop = true;
                    break;

                  case "meet":
                    align.crop = false;
                }
              });
          }

          // Add 360deg transformation to style to prevent subpixel rendering bug
          style +=
            "-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);";

          // Generate style
          result.style =
            style + (attributes.style === void 0 ? "" : attributes.style);

          // Generate viewBox and preserveAspectRatio attributes
          result.preserveAspectRatio = this.preserveAspectRatio(
            align.horizontal,
            align.vertical,
            align.crop
          );
          result.viewBox =
            box.left + " " + box.top + " " + box.width + " " + box.height;

          // Generate body
          body = replaceIDs(this.item.body);

          if (transformations.length) {
            body =
              '<g transform="' + transformations.join(" ") + '">' + body + "</g>";
          }

          // Add misc attributes
          extraAttributes = Object.create(null);
          Object.keys(attributes).forEach(function (attr) {
            if (result[attr] === void 0) {
              if (attributesToTags.indexOf(attr) !== -1) {
                body =
                  "<" +
                  attr +
                  ">" +
                  instance.htmlspecialchars(attributes[attr]) +
                  "</" +
                  attr +
                  ">" +
                  body;
              } else if (reservedAttributes.indexOf(attr) === -1) {
                extraAttributes[attr] = attributes[attr];
              }
            }
          });

          return {
            attributes: result,
            elementAttributes: extraAttributes,
            body: body,
            append: append,
            // Style split, duplicate ot attributes.style
            verticalAlign: verticalAlign,
          };
        };

        return this;
      }

      // Node.js only

      local.SVG = SVG;
    })();

    /**
     * Functions that create image objects
     */
    (function (local, config) {
      var loadingClass = config._loadingClass;

      /**
       * Create object for new image
       *
       * @param {Element} element DOM element
       * @param {string} icon Icon name
       * @param {function} parser Parser function
       * @return {{element: Element, icon: string, parser: function, loading: boolean}}
       */
      local.newImage = function (element, icon, parser) {
        return {
          element: element,
          icon: icon,
          parser: parser,
          loading: element.classList.contains(loadingClass),
        };
      };

      /**
       * Create object for parsed image
       *
       * @param {Element} element DOM element
       * @param {string} icon Icon name
       * @return {{element: Element, icon: string}}
       */
      local.parsedImage = function (element, icon) {
        return {
          element: element,
          icon: icon,
        };
      };

      /**
       * Get image attributes to pass to SVG
       *
       * @param {object} image
       * @return {object}
       */
      local.getImageAttributes = function (image) {
        var results = Object.create(null),
          i,
          attr;

        if (!image.element.hasAttributes()) {
          return results;
        }

        // Copy all attributes
        for (i = 0; i < image.element.attributes.length; i++) {
          attr = image.element.attributes[i];
          results[attr.name] = attr.value;
        }

        // Filter attributes
        if (image.parser && image.parser.filterAttributes !== void 0) {
          results = image.parser.filterAttributes(image, results);
        }

        // Filter class names
        if (results["class"] !== void 0) {
          results["class"] = results["class"].split(" ").filter(function (item) {
            return item !== loadingClass;
          });

          if (image.parser && image.parser.filterClasses !== void 0) {
            results["class"] = image.parser.filterClasses(image, results["class"]);
          }

          results["class"] = results["class"].join(" ");
        }

        // Add attributes from image
        if (image.attributes !== void 0) {
          Object.keys(image.attributes).forEach(function (attr) {
            results[attr] = image.attributes[attr];
          });
        }

        return results;
      };
    })(local, local.config);

    /**
     * Functions that find images in DOM
     */
    (function (Iconify, local, config) {
      var imageClass = config._imageClass,
        loadingClass = config._loadingClass,
        appendedClass = config._appendedClass,
        iconAttribute = config._iconAttribute,
        inlineAttribute = config._inlineModeAttribute,
        negativeSelectors = ":not(svg):not(." + appendedClass + ")",
        negativeLoadingSelectors = ":not(." + loadingClass + ")",
        loadingSelector = "." + loadingClass;

      /**
       * List of finders
       *
       * @type {object}
       */
      var finders = {
        iconify: {
          selector: "." + imageClass,
          selectorAll: "." + imageClass + negativeSelectors,
          selectorNew:
            "." + imageClass + negativeSelectors + negativeLoadingSelectors,
          selectorLoading: "." + imageClass + negativeSelectors + loadingSelector,

          /**
           * Get icon name from element
           *
           * @param {Element} element
           * @return {string} Icon name, empty string if none
           */
          icon: function (element) {
            var result = element.getAttribute(iconAttribute),
              item;

            if (typeof result === "string") {
              return result;
            }

            // Look for icon:icon-name format (icon:fa-home, icon:emojione-monotone:cat)
            for (var i = 0; i < element.classList.length; i++) {
              item = element.classList[i];
              if (item.length > 5 && item.slice(0, 5) === "icon:") {
                return item.slice(5);
              }
            }

            return "";
          },

          /**
           * Filter class names list, removing any custom classes
           *
           * If function is missing in finder, classes will not be filtered
           *
           * @param {object} image
           * @param {Array|DOMTokenList} list
           * @return {Array}
           */
          filterClasses: function (image, list) {
            var item, i, attr;

            // Copy icon-foo:bar classes as data-foo=bar attributes to make it possible to use class names instead of attributes.
            // Prefix "icon-" is removed.
            // icon-width:24px -> data-width="24px"
            // If both class and attribute are present, class has higher priority (to reduce number of checks).
            for (i = 0; i < list.length; i++) {
              item = list[i];
              if (item.slice(0, 5) === "icon-") {
                item = item.slice(5).split(":");
                if (item.length === 2) {
                  attr = "data-" + item[0];
                  if (image.attributes === void 0) {
                    image.attributes = Object.create(null);
                  }
                  image.attributes[attr] = item[1];
                }
              }
            }

            return list;
          },

          /**
           * Filter attributes, removing any attributes that should not be passed to SVG
           *
           * If function is missing in finder, attributes will not be filtered
           *
           * @param {object} image
           * @param {object} attributes
           * @return {object}
           */
          // filterAttributes: function(image, attributes) { return attributes; }
        },
      };

      /**
       * List of finder keys for faster iteration
       *
       * @type {Array}
       */
      var finderKeys = Object.keys(finders);

      /**
       * Add custom finder
       *
       * @param {string} name Finder name
       * @param {object} finder Finder data
       */
      Iconify.addFinder = function (name, finder) {
        // Set missing properties
        if (finder.selectorAll === void 0) {
          finder.selectorAll = finder.selector + negativeSelectors;
        }
        if (finder.selectorNew === void 0) {
          finder.selectorNew =
            finder.selector + negativeSelectors + negativeLoadingSelectors;
        }
        if (finder.selectorLoading === void 0) {
          finder.selectorLoading =
            finder.selector + negativeSelectors + loadingSelector;
        }

        finders[name] = finder;
        finderKeys = Object.keys(finders);

        // Re-scan DOM
        if (Iconify.isReady) {
          Iconify.scanDOM();
        }
      };

      /**
       * Add custom tag finder
       *
       * @param {string} name Tag name
       * @param {boolean} inline True/false if icon should be inline by default
       * @param {function} [resolver] Function to return icon name, null or undefined if default resolver should be used
       */
      Iconify.addTag = function (name, inline, resolver) {
        Iconify.addFinder("tag-" + name, {
          selector: name,
          icon:
            resolver === void 0 || resolver === null
              ? finders.iconify.icon
              : resolver,
          filterAttributes: function (image, attributes) {
            if (attributes[inlineAttribute] === void 0) {
              attributes[inlineAttribute] = inline;
            }
            return attributes;
          },
          filterClasses: finders.iconify.filterClasses,
        });
      };

      // Add custom iconify-icon tag
      try {
        // Try to create custom element interface if browser supports it.
        // If browser doesn't support it, it will fall back to HTMLUnknownElement, which is
        // fine because iconify-icon doesn't have any custom behavior or attributes.
        if (
          typeof Reflect === "object" &&
          typeof customElements === "object" &&
          Object.setPrototypeOf
        )
          (function () {
            function El() {
              return Reflect.construct(HTMLElement, [], El);
            }
            Object.setPrototypeOf(El.prototype, HTMLElement.prototype);
            Object.setPrototypeOf(El, HTMLElement);
            customElements.define("iconify-icon", El);
          })();
      } catch (err) {}
      Iconify.addTag("iconify-icon", false);

      /**
       * Find new images
       *
       * @param {Element} root Root element
       * @param {boolean} [loading] Filter images by loading status. If missing, result will not be filtered
       * @return {Array}
       */
      local.findNewImages = function (root, loading) {
        var results = [],
          duplicates = [];

        root =
          root === void 0
            ? config._root === void 0
              ? document.body
              : config._root
            : root;
        if (!root) {
          return results;
        }

        finderKeys.forEach(function (key) {
          var finder = finders[key],
            selector =
              loading === true
                ? finder.selectorLoading
                : loading === false
                ? finder.selectorNew
                : finder.selectorAll;

          var nodes = root.querySelectorAll(selector),
            index,
            node,
            icon,
            image;

          for (index = 0; index < nodes.length; index++) {
            node = nodes[index];
            icon = finder.icon(node);

            if (icon && duplicates.indexOf(node) === -1) {
              duplicates.push(node);
              image = local.newImage(node, icon, finder);
              results.push(image);
            }
          }
        });

        return results;
      };

      /**
       * Find all svg images
       *
       * @param {Element} root Root element
       * @return {Array}
       */
      local.findParsedImages = function (root) {
        var results = [];

        var nodes = root.querySelectorAll("svg." + imageClass),
          index,
          node,
          icon;

        for (index = 0; index < nodes.length; index++) {
          node = nodes[index];
          icon = node.getAttribute(iconAttribute);

          if (icon) {
            results.push(local.parsedImage(node, icon));
          }
        }

        return results;
      };
    })(Iconify, local, local.config);

    /**
     * Module for loading images from remote location
     */
    (function (Iconify, local, config, global) {
      /**
       * List of images queued for loading.
       *
       * key = prefix
       * value = array of queued images
       *
       * @type {{Array}}
       */
      var queue = Object.create(null);

      /**
       * List of images queued for loading.
       *
       * key = prefix
       * value === true -> entire collection has been queued, value === {Array} -> list of tested images
       *
       * @type {{Array}|{boolean}}
       */
      var tested = Object.create(null);

      /**
       * Additional queue for icons to queue when DOM is ready
       *
       * @type {object}
       */
      var domqueue = Object.create(null);

      /**
       * True if queue will be parsed on next tick
       *
       * @type {boolean}
       */
      var queued = false;

      /**
       * True if storage should be used (must be enabled before including script)
       *
       * @type {{boolean}}
       */
      var useStorage = {
        session: true,
        local: true,
      };

      /**
       * Index for last stored data in storage
       *
       * @type {{number}}
       */
      var storageIndex = {
        session: 0,
        local: 0,
      };

      /**
       * Load all queued images
       */
      function loadQueue() {
        var limit = config.loaderMaxURLSize,
          urls = Object.create(null);

        /**
         * Send JSONP request by adding script tag to document
         *
         * @param {string} prefix
         * @param {Array} items
         */
        function addScript(prefix, items) {
          var url = urls[prefix],
            element;

          if (typeof url === "function") {
            url.call(Iconify, prefix, items);
            return;
          }

          // Replace icons list
          url = url.replace("{icons}", items.join(","));

          // Create script
          element = document.createElement("script");
          element.setAttribute("type", "text/javascript");
          element.setAttribute("src", url);
          element.setAttribute("async", true);
          document.head.appendChild(element);
        }

        /**
         * Calculate base length of URL
         *
         * Returns:
         *  length of url without icons for valid urls
         *  null if url does not include icons list (loading entire collection)
         *  false if url is a callback (no length limits, its up to callback to split url)
         *
         * @param {string} prefix
         * @return {number|null|false}
         */
        function baseLength(prefix) {
          var url =
            config.API[prefix] === void 0 ? config.defaultAPI : config.API[prefix];

          if (typeof url === "function") {
            urls[prefix] = url;
            return false;
          }
          if (url.indexOf("{icons}") === -1) {
            urls[prefix] = url;
            return null;
          }
          url = url
            .replace("{prefix}", prefix)
            .replace("{callback}", "Iconify._loaderCallback");
          urls[prefix] = url;
          return url.replace("{icons}", "").length;
        }

        // Check queue
        Object.keys(queue).forEach(function (prefix) {
          var URLLength = baseLength(prefix),
            isCallback = URLLength === false,
            queued = [];

          if (URLLength === null) {
            // URL without list of icons - loads entire library
            addScript(prefix, []);
            tested[prefix] = true;
            return;
          }

          queue[prefix].forEach(function (icon, index) {
            if (!isCallback) {
              URLLength += icon.length + 1;
              if (URLLength >= limit) {
                addScript(prefix, queued);
                queued = [];
                URLLength = baseLength(prefix) + icon.length + 1;
              }
            }
            queued.push(icon);
          });

          // Get remaining items
          if (queued.length) {
            addScript(prefix, queued);
          }

          // Mark icons as loaded
          tested[prefix] =
            tested[prefix] === void 0
              ? queue[prefix]
              : tested[prefix].concat(queue[prefix]);
          delete queue[prefix];
        });

        queued = false;
      }

      /**
       * Load queue. Delay queue if DOM isn't ready
       */
      function addToDOMReadyQueue(prefix, icon) {
        if (domqueue[prefix] === void 0) {
          domqueue[prefix] = Object.create(null);
        }
        domqueue[prefix][icon] = true;

        // Add callback
        if (local._loaderDOMReady !== void 0) {
          return;
        }
        local._loaderDOMReady = local.DOMReadyCallback;
        local.DOMReadyCallback = function () {
          local._loaderDOMReady();
          Object.keys(domqueue).forEach(function (prefix) {
            Object.keys(domqueue[prefix]).forEach(function (icon) {
              if (!Iconify.iconExists(icon, prefix)) {
                addToQueue(prefix, icon, true);
              }
            });
          });
        };
      }

      /**
       * Add image to loading queue
       *
       * @param {string} prefix Collection prefix
       * @param {string} icon Image name
       * @param {boolean} preload True if icon is being pre-loaded
       * @return {boolean} True if image was added to queue
       */
      function addToQueue(prefix, icon, preload) {
        // Check if DOM is ready
        if (!preload && !local.domready && !config.loadBeforeDOMReady) {
          addToDOMReadyQueue(prefix, icon);
          return true;
        }

        // Check queue
        if (
          (queue[prefix] !== void 0 && queue[prefix].indexOf(icon) !== -1) ||
          (tested[prefix] !== void 0 &&
            (tested[prefix] === true || tested[prefix].indexOf(icon) !== -1))
        ) {
          return false;
        }

        // Add to queue
        if (queue[prefix] === void 0) {
          queue[prefix] = [];
        }
        queue[prefix].push(icon);
        if (!queued) {
          queued = true;
          window.setTimeout(loadQueue, 0);
        }
        return true;
      }

      /**
       * Callback for JSONP
       *
       * @param {object} data
       * @constructor
       */
      Iconify._loaderCallback = function (data) {
        var stored = false;

        if (typeof data === "object") {
          // Add to storage
          ["local", "session"].forEach(function (key) {
            var func;

            if (stored || !useStorage[key] || !config[key + "Storage"]) {
              return;
            }
            func = global[key + "Storage"];
            try {
              if (!storageIndex[key]) {
                func.setItem("iconify-version", local.version);
              }
              func.setItem("iconify" + storageIndex[key], JSON.stringify(data));
              stored = true;
              storageIndex[key]++;
              func.setItem("iconify-count", storageIndex[key]);
            } catch (err) {
              useStorage[key] = false;
            }
          });

          // Add icons to collection and parse icons
          Iconify.addCollection(data);

          // Dispatch event
          local.event(config._loaderEvent);
        }
      };

      /**
       * Add image to queue, return true if image has been loaded
       *
       * @param {object} image Image object
       * @param {boolean} [checkQueue] True if queue should be checked. Default = true
       * @return {boolean}
       */
      local.loadImage = function (image, checkQueue) {
        var icon = local.getPrefix(image.icon);

        if (Iconify.iconExists(icon.icon, icon.prefix)) {
          return true;
        }

        if (checkQueue !== false && addToQueue(icon.prefix, icon.icon, false)) {
          // Mark as loading
          image.element.classList.add(config._loadingClass);
        }

        return false;
      };

      /**
       * Preload images
       *
       * @param {Array} images List of images
       * @returns {boolean} True if images are queued for preload, false if images are already available
       */
      Iconify.preloadImages = function (images) {
        var preloading = false,
          icon;

        images.forEach(function (key) {
          icon = local.getPrefix(key);
          if (!Iconify.iconExists(icon.icon, icon.prefix)) {
            addToQueue(icon.prefix, icon.icon, true);
            preloading = true;
          }
        });
        return preloading;
      };

      /**
       * Load data from session storage
       */
      (function () {
        ["local", "session"].forEach(function (key) {
          var func, item, limit;

          try {
            func = global[key + "Storage"];

            if (typeof func !== "object") {
              useStorage[key] = false;
              return;
            }

            if (func.getItem("iconify-version") !== local.version) {
              // Ignore stored data, overwrite it starting with index 0
              return;
            }

            limit = parseInt(func.getItem("iconify-count"));
            if (typeof limit !== "number" || isNaN(limit)) {
              return;
            }

            // Get all data from storage until first error is encountered
            while (true) {
              if (storageIndex[key] >= limit) {
                return;
              }
              item = func.getItem("iconify" + storageIndex[key]);
              if (typeof item === "string") {
                item = JSON.parse(item);
                if (typeof item === "object") {
                  Iconify.addCollection(item);
                }
              } else {
                return;
              }
              storageIndex[key]++;
            }
          } catch (err) {
            useStorage[key] = false;
          }
        });
      })();
    })(Iconify, local, local.config, global);

    /**
     * Observer function
     *
     * Observer automatically loads polyfill for MutationObserver for IE9-10 from CDN that can be configured
     * See ../polyfill.js
     *
     * Observer can be paused using Iconify.pauseObserving()
     * and resumed using Iconify.resumeObserving()
     * Pause/resume can stack, so if you call pause twice, resume should be called twice.
     */
    (function (Iconify, local, config, global) {
      var observer = null,
        paused = 0,
        queue = null,
        addedNodes = false,
        params = {
          childList: true,
          subtree: true,
        };

      /**
       * Process all pending mutations
       */
      function processPendingMutations() {
        var temp;

        if (addedNodes !== false && addedNodes.length) {
          temp = addedNodes;
          addedNodes = false;
          local.scanDOM(temp);
        } else {
          addedNodes = false;
        }
      }

      /**
       * Process array of mutations
       *
       * @param mutations
       */
      function processMutations(mutations) {
        mutations.forEach(function (mutation) {
          var i;

          // Parse on next tick to collect all mutations
          if (addedNodes === false) {
            addedNodes = [];
            window.setTimeout(processPendingMutations, 0);
          }
          if (mutation.addedNodes) {
            for (i = 0; i < mutation.addedNodes.length; i++) {
              addedNodes.push(mutation.addedNodes[i]);
            }
          }
        });
      }

      /**
       * Start/resume observing
       */
      function observe() {
        observer.observe(
          config._root === void 0 ? document.querySelector("body") : config._root,
          params
        );
      }

      /**
       * Function to pause observing
       *
       * Multiple pauseObserving() calls stack, resuming observer only when same amount of resumeObserving() is called
       */
      Iconify.pauseObserving = function () {
        if (observer === null) {
          paused++;
          return;
        }

        if (!paused) {
          // Store pending records, stop observer
          queue = observer.takeRecords();
          observer.disconnect();
        }
        paused++;
      };

      /**
       * Function to resume observing
       */
      Iconify.resumeObserving = function () {
        if (observer === null) {
          paused--;
          return;
        }
        if (!paused) {
          return;
        }

        paused--;
        if (!paused) {
          // Resume observer and process stored records
          observe();
          if (queue !== null && queue.length) {
            processMutations(queue);
          }
        }
      };

      /**
       * Check if observer is paused
       *
       * @returns {boolean}
       */
      Iconify.isObserverPaused = function () {
        return observer === null || !!paused;
      };

      /**
       * Start observing when all modules and DOM are ready
       */
      local.readyQueue.push(function () {
        observer = new global.MutationObserver(processMutations);
        if (!paused) {
          observe();
        }
        return true;
      });
    })(Iconify, local, local.config, global);

    /**
     * Module for changing images
     */
    (function (Iconify, local, config) {
      var iconAttribute = config._iconAttribute,
        loadingClass = config._loadingClass,
        imageClass = config._imageClass,
        appendedClass = config._appendedClass;

      /**
       * Generate SVG code
       *
       * @param {string} html Empty SVG element with all attributes
       * @param {string} body Body
       * @return {string}
       */
      function generateSVG(html, body) {
        var pos;

        if (html.slice(0, 2) === "<?") {
          // XML prefix from old IE
          pos = html.indexOf(">");
          html = html.slice(pos + 1);
        }

        // Fix lower case attributes
        html = html
          .replace("viewbox=", "viewBox=")
          .replace("preserveaspectratio=", "preserveAspectRatio=");

        // Add body
        pos = html.indexOf("</");
        if (pos !== -1) {
          // Closing tag
          html = html.replace("</", body + "</");
        } else {
          // Self-closing
          html = html.replace("/>", ">" + body + "</svg>");
        }

        return html;
      }

      /**
       * Render SVG
       *
       * @param {object} image
       */
      local.renderSVG = function (image) {
        var attributes = local.getImageAttributes(image),
          item = Iconify.getIcon(image.icon),
          svgObject,
          svgElement,
          temp,
          span,
          data,
          html,
          svgStyle,
          placeholderStyle,
          i,
          attr,
          attrValue;

        attributes[iconAttribute] = image.icon;
        svgObject = new local.SVG(item);
        temp = document.createElement("svg");

        data = svgObject.attributes(attributes);

        // Add attributes generated by svg.attributes()
        Object.keys(data.attributes).forEach(function (attr) {
          attrValue = data.attributes[attr];
          if (attr === "style") {
            attrValue = image.element.getAttribute("style");
            if (typeof attrValue !== "string" || !attrValue.length) {
              return;
            }
          }
          try {
            temp.setAttribute(attr, attrValue);
          } catch (err) {}
        });

        // Add element attributes to SVG
        Object.keys(data.elementAttributes).forEach(function (attr) {
          try {
            (data.append ? image.element : temp).setAttribute(
              attr,
              data.elementAttributes[attr]
            );
          } catch (err) {}
        });

        if (image.loading) {
          temp.classList.remove(loadingClass);
          if (data.append) {
            image.element.classList.remove(loadingClass);
          }
        }
        temp.classList.add(imageClass);

        // innerHTML is not supported for SVG element :(
        // Creating temporary element instead
        html = generateSVG(temp.outerHTML, data.body);

        span = document.createElement("span");
        span.innerHTML = html;

        svgElement = span.childNodes[0];

        if (data.append) {
          image.element.classList.add(appendedClass);
          image.element.appendChild(svgElement);
        } else {
          image.element.parentNode.replaceChild(svgElement, image.element);
          image.element = svgElement;
        }

        // Copy style and add inline style
        svgStyle = svgElement.style;
        placeholderStyle = image.element.style;
        if (data.verticalAlign) {
          svgStyle.verticalAlign = data.verticalAlign;
        }
        svgStyle.transform = "rotate(360deg)";

        for (i = 0; i < placeholderStyle.length; i++) {
          attr = placeholderStyle[i];
          svgStyle[attr] = placeholderStyle[attr];
        }

        delete image.parser;
        delete image.loading;
      };

      /**
       * Get SVG icon as object
       *
       * @param name
       * @param properties
       * @return {object|false}
       *  Result object keys:
       *	  attributes = list of attributes
       *	  body = SVG code
       *	  append = boolean if icon should be appended to container
       *	  elementAttributes = list of attributes from container (exists only if icon is appended)
       */
      Iconify.getSVGObject = function (name, properties) {
        var svg;

        if (!Iconify.iconExists(name)) {
          return false;
        }

        svg = new local.SVG(Iconify.getIcon(name));
        return svg.attributes(properties, false);
      };

      /**
       * Get SVG icon code
       *
       * @param {string} name Icon name
       * @param {object} [properties] Custom properties
       * @return {string|boolean}
       */
      Iconify.getSVG = function (name, properties) {
        var el, data;

        data = Iconify.getSVGObject(name, properties);
        if (data === false) {
          return false;
        }

        el = document.createElement("svg");
        Object.keys(data.attributes).forEach(function (attr) {
          try {
            el.setAttribute(attr, data.attributes[attr]);
          } catch (err) {}
        });

        return generateSVG(el.outerHTML, data.body);
      };
    })(Iconify, local, local.config);

    /**
     * Main file
     */
    (function (Iconify, local) {
      /**
       * Find new icons and change them
       */
      local.scanDOM = function () {
        var paused = false;

        function scan() {
          local.findNewImages().forEach(function (image) {
            if (local.loadImage(image)) {
              if (!paused) {
                paused = true;
                Iconify.pauseObserving();
              }

              local.renderSVG(image);
            }
          });
        }

        if (local.ready) {
          scan();
        } else {
          // Use try-catch if DOM is not ready yet
          try {
            scan();
          } catch (err) {}
        }

        if (paused) {
          Iconify.resumeObserving();
        }
      };

      /**
       * Export function to scan DOM
       */
      Iconify.scanDOM = local.scanDOM;

      /**
       * Get version
       *
       * @return {string}
       */
      Iconify.getVersion = function () {
        return local.version;
      };
    })(Iconify, local);
  })(self.Iconify, self);
}

// Allow bundling with WebPack
if (typeof exports === "object") {
  try {
    exports.__esModule = true;
    exports.default = self.Iconify;
  } catch (err) {}
}
