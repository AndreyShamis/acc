/*
                Super Browser Detection JavaScript
                                10.11.2010 01:54
*/
var nav = new Array(2); //  navigator[array]
var browser = new Array (
    /Firefox\/(\d+)/i,  //
    /MSIE (\d+)./i,     //
    /Chrome\/(\d+)/i,   //
    /Opera\/(\d+)/i,    //
    /Version\/(\d+)/i   //
);
//
for(var i in browser)
{
    if(browser[i].test(navigator.userAgent))
    {
        nav['id'] = i;              //  browser[array] id
        nav['version'] = RegExp.$1; //  browser[array] detected RegExp version
    }
}
//
var csslink;    // CSS file for current browser
//
switch(nav['id'])
{
    case '0':
        //  Firefox
        if(nav['version']>=6)       csslink = 'ff6';
        else if(nav['version']>=5)  csslink = 'ff5';
        else if(nav['version']>=4)  csslink = 'ff4';
        else if(nav['version']>=3)  csslink = 'ff3';
        else if(nav['version']>=2)  csslink = 'ff2';
        break;
    case '1':
        //  MSIE
        if(nav['version']>=9)       csslink = 'ie9';
        else if(nav['version']>=8)  csslink = 'ie8';
        else if(nav['version']>=7)  csslink = 'ie7';
        else if(nav['version']>=6)  csslink = 'ie6';
        else if(nav['version']>=5)  csslink = 'ie5';
        break;
    case '2':
        //  Chrome
        if(nav['version']>=13)      csslink = 'chrome13';
        else if(nav['version']>=12) csslink = 'chrome12';
        else if(nav['version']>=11) csslink = 'chrome11';
        else if(nav['version']>=10) csslink = 'chrome10';
        else if(nav['version']>=9)  csslink = 'chrome9';
        else if(nav['version']>=8)  csslink = 'chrome8';
        else if(nav['version']>=7)  csslink = 'chrome7';
        else if(nav['version']>=6)  csslink = 'chrome6';
        else if(nav['version']>=5)  csslink = 'chrome5';
        break;
    case '3':
        //  Opera
        if(nav['version']>=10)      csslink = 'opera10';
        else if(nav['version']>=9)  csslink = 'opera9';
        else if(nav['version']>=8)  csslink = 'opera8';
        else if(nav['version']>=7)  csslink = 'opera7';
        break;
    case '4':
        //  Safari
        if(nav['version']>=5)       csslink = 'safari5';
        else if(nav['version']>=4)  csslink = 'safari4';
        else if(nav['version']>=3)  csslink = 'safari3';
        else if(nav['version']>=3)  csslink = 'safari2';
        break;
}
//  print link object for current detected browser
//document.write('<br/>css/'+ csslink +'.css');
//document.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/"+ csslink +".css\" media=\"screen\" />");
document.getElementById('browser_version').href = 'css/'+ csslink +'.css';

/* разложить обьект navigator.plugins на элементы
for(property in navigator.plugins)
{
    for(prop in navigator.plugins[property])
    {
        document.write(prop +' : '+ navigator.plugins[property][prop]  +'<br />');
    }
}
*/

/* показать все плагины : имя и версия(в ИЕ не работает)
for(property in navigator.plugins)
{
    document.write(property +' : '+
        navigator.plugins[property].name  +'<br />'+
        navigator.plugins[property].version  +'<br />'

    );
}
*/
