var Apaging = Class.create(); //tao 1 class
Apaging.prototype = {
    initialize: function() { //khoi tao
        this.request = null;
        this.url = null;
        this.pop = false; //pop la cai gi
        document.observe("dom:loaded", this.olinks.bind(this));
        window.onpopstate = function(event) {
            if (event && event.state) {
                this.pop = true;
                this.riff(location.href)
            }
        }.bind(this)
    },
    riff: function(u) {
        this.url = u.sub("ajax=1&", "").sub("&ajax=1", "");
        var params = {};
        if (!u.include("ajax=1")) {
            params = {
                "ajax": 1
            }
        }
        if (this.request !== null) {
            this.request.abort()
        }
        this.request = new Ajax.Request(u, {
            method: 'get',
            parameters: params,
            onSuccess: this.glist.bind(this),
            onComplete: this.olinks.bind(this)
        })
    },
    getResult: function(event) {
        event.preventDefault();
        sEle = Event.element(event);
        url = '';
        tag = sEle.tagName.toLowerCase();

        if(tag== "a" && sEle.href){
            url=sEle.href;
        }
        if (url != "#" || url !== '') {
            this.riff(url)
        }
        return
    },
    olinks: function() {
        $$('.pages li a', '.view-mode a', '.sorter a').invoke('observe', 'click', this.getResult.bind(this));
        //phan trang, view-mode, sap xep
    },
    // rlinks: function() {
    //     $$('.pages li a', '.view-mode a', '.sorter a').invoke('stopObserving', 'click');
    //
    // },
    glist: function(transport) {
        //this.rlinks();
        ft = transport.responseText;
        if (typeof(history.pushState) == 'function') {
            if (this.pop === false) {
                history.pushState({
                    url: this.url
                }, document.title, this.url)
            } else {
                this.pop = false
            }
        }
        var bagEle = new Element('div'); //khoi tao div
        bagEle.update(ft);
        var plist = bagEle.select('div#ajax-list-container')[0]; //???
        $$('.category-products').each(function(item) {
            Element.replace(item, plist.innerHTML)
        });
       // document.body.fire('list:loaded')
    },
};
 Object.extend(Ajax);
Ajax.Request.prototype.abort = function() {
    this.transport.onreadystatechange = Prototype.emptyFunction;
    this.transport.abort();
    Ajax.activeRequestCount--
};
var ajaxpaging = new Apaging();