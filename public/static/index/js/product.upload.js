let picmax = 8; //限制上传数量 
function imgChange(key) {
    let file = document.getElementById('file_'+key).files;
    let imglist = document.querySelectorAll('.upload-Picitem .upload-Picitem_'+key);
    let piclist = document.getElementsByClassName('upload-piclist_'+key)[0];
    let filelist = file.length + imglist.length > picmax ? 8 - imglist.length : file.length + imglist.length;
    if (file.length + imglist.length >= 8) {
        let uploadfile = document.getElementsByClassName('upload-file_'+key)[0]
        uploadfile.style.display = "none"
    }
    for (let i = 0; i < filelist; i++) {
        readerfile(file[i]).then(e => {
            $.ajax({
                url: "/upload_post",
                method: 'POST',
                data: {
                    result: e,
                },
                success: function(res) {
                    if (res.code === 200) {
                        let html = document.createElement('div');
                        html.className = 'upload-Picitem upload-Picitem_'+key
                        html.innerHTML = '<img src=' + res.data + ' alt="pic"> <div class="imgDelete" onclick="imgDelete(this, '+key+')"></div>'
                        piclist.appendChild(html);

                    } else {
                        toast({time: 3000, msg: res.message});
                    }
                }
            });
        })
    }
}
function readerfile(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.addEventListener("load", function() {
            resolve(reader.result);
        }, false)
        if (file) {
            reader.readAsDataURL(file)
        }
    })
}


function imgDelete(element, key) {
    var parentItem = element.parentNode; // 获取父元素 upload-Picitem
    var uploadPiclist = parentItem.parentNode; // 获取父元素 upload-piclist
    uploadPiclist.removeChild(parentItem); // 从 upload-piclist 中移除 upload-Picitem
    
    let uploadfile = document.getElementsByClassName('upload-file_'+key)[0]
    uploadfile.style.display = ""
}
//提交
function submit() {
    let imglist = []
    let text = document.getElementsByClassName('upload-textarea')[0].value
    let piclist = document.querySelectorAll('.upload-Picitem');
    for (let i = 0; i < piclist.length; i++) {
        imglist.push(piclist[i].lastChild.src)
    }
    console.log("发布内容：", text)
    console.log("图片列表：", imglist)
}


//textarea高度自适应
var autoTextarea = function(elem, extra, maxHeight) {
    extra = extra || 0;
    var isFirefox = !!document.getBoxObjectFor || 'mozInnerScreenX' in window,
        isOpera = !!window.opera && !!window.opera.toString().indexOf('Opera'),
        addEvent = function(type, callback) {
            elem.addEventListener ?
                elem.addEventListener(type, callback, false) :
                elem.attachEvent('on' + type, callback);
        },
        getStyle = elem.currentStyle ? function(name) {
            var val = elem.currentStyle[name];

            if (name === 'height' && val.search(/px/i) !== 1) {
                var rect = elem.getBoundingClientRect();
                return rect.bottom - rect.top -
                    parseFloat(getStyle('paddingTop')) -
                    parseFloat(getStyle('paddingBottom')) + 'px';
            };

            return val;
        } : function(name) {
            return getComputedStyle(elem, null)[name];
        },
        minHeight = parseFloat(getStyle('height'));

    elem.style.resize = 'none';

    var change = function() {
        var scrollTop, height,
            padding = 0,
            style = elem.style;

        if (elem._length === elem.value.length) return;
        elem._length = elem.value.length;

        if (!isFirefox && !isOpera) {
            padding = parseInt(getStyle('paddingTop')) + parseInt(getStyle('paddingBottom'));
        };
        scrollTop = document.body.scrollTop || document.documentElement.scrollTop;

        elem.style.height = minHeight + 'px';
        if (elem.scrollHeight > minHeight) {
            if (maxHeight && elem.scrollHeight > maxHeight) {
                height = maxHeight - padding;
                style.overflowY = 'auto';
            } else {
                height = elem.scrollHeight - padding;
                style.overflowY = 'hidden';
            };
            style.height = height + extra + 'px';
            scrollTop += parseInt(style.height) - elem.currHeight;
            document.body.scrollTop = scrollTop;
            document.documentElement.scrollTop = scrollTop;
            elem.currHeight = parseInt(style.height);
        };
    };

    // addEvent('propertychange', change);
    // addEvent('input', change);
    // addEvent('focus', change);
    change();
};