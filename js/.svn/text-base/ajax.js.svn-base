//  AJAX  by qpayct 31.05.2011 ..
//_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_|_
function RunAjax(url, execute)
{
var xmlhttp;
var _OnLoad      = function () { }
var _OnComplete  = function () { }
var _OnError     = function () { }
var Execute     = function (responseText) {
    var obj = document.createElement('div');
    obj.innerHTML = responseText;
    var elts = obj.getElementsByTagName('script');
        for(var i = 0; i < elts.length; i++) {
            eval(elts[i].text);
            elts[i].parentNode.removeChild(elts[i]);
        }
    }

    this.OnLoad = function (fn) {_OnLoad = fn;}
    this.OnComplete = function (fn) {_OnComplete = fn;}
    this.OnError = function (fn) {_OnError = fn;}
    this.Post = function (params) {
        if(this.RequestPrepare()) {
            params = this.StrPrepare(params);
            xmlhttp.open('POST', url, true);
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=utf-8');
            xmlhttp.setRequestHeader('Content-length', params.length);
            xmlhttp.setRequestHeader('Connection', 'close');
            xmlhttp.send(params);
        }
    }
    this.Get = function (params) {
        if(this.RequestPrepare()) {
            url += this.StrPrepare(params);
            xmlhttp.open('GET', url, true);
            xmlhttp.send(null);
        }
    }
    this.RequestPrepare = function () {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
            if (xmlhttp.overrideMimeType) {
                xmlhttp.overrideMimeType('text/html');
            }
        } else if (window.ActiveXObject) {
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }

        if (typeof xmlhttp == 'undefined') {
            alert('Cannot create XMLHTTP instance.');
            return false;
        }

        xmlhttp.onreadystatechange = function(e) {
            if (xmlhttp.readyState == 1) {
                _OnLoad();
            }
            if (xmlhttp.readyState == 4) {
                if(xmlhttp.status == 200) {
                    if(execute === true) {Execute(xmlhttp.responseText);}
                    _OnComplete(xmlhttp.responseText);
                } else {
                    _OnError(xmlhttp.status);
                }
            }
        }
        return true;
    }
    this.StrPrepare = function (obj) {
        if(obj instanceof Object) {
            var i = 0;
            var arr = [];
            for (var key in obj) {
                arr[i++] = encodeURIComponent(key) + '=' + encodeURIComponent(obj[key]);
            }
            return arr.join('&');
        } else {
            return '';
        }
    }

}


//var xmlhttp = build_xmlhttpObject();
/*
function build_xmlhttpObject() {
    if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
    else if (window.ActiveXObject) xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    else return;
    return xmlhttp;
}
//
function runAjax(query, url, method, freim) {
    if (method == 'GET') url = url +'?'+ query;
    xmlhttp.open(method, url , true );
    xmlhttp.onreadystatechange=function() {if(xmlhttp.readyState==4 && xmlhttp.status==200) {document.getElementById(freim).innerHTML=xmlhttp.responseText;}}
    switch(method)
    {
        case 'POST':
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(query);
            break;
        case 'GET':
            xmlhttp.send();
            break;
        default:
            xmlhttp.send(Null);
            break;
    }
}
*/