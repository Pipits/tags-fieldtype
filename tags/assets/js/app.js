/**
 * forEach polyfill
 */
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}


var tagifyInputs = document.querySelectorAll('[data-pipit-tagify]');

tagifyInputs.forEach(element => {
    var opts = {};
    
    if(element.dataset.max) {
		opts.maxTags = element.dataset.max;
    }

    if(element.dataset.blacklist) {
		opts.blacklist = element.dataset.blacklist.split(",");
    }
    
    tagify = new Tagify(element, opts);
});