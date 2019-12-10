var tmmp, tfile, nfile, k;
using = function(url) {
    $.get(url, data => {
        // $("head").append("<style>" + data + "</style>");
        $("head").prepend("<style>" + data + "</style>");
    });
};
app = $(document);
create = function(type) {
    let result = document.createElement(type.content);
    $.each(type, (key, val) => {
        if (key == "content") {} else if (key == "css") {
            let sname = "";
            $.each(val, (k, v) => {
                sname += k + ":" + v + "";
            });
            result.setAttribute("style", sname);
        } else if (key == "val") {
            result.append(val);
        } else {
            result.setAttribute(key, val);
        }
    });

    result.render = () => {
        document.body.appendChild(result);
    };
    result.child = child => {
        result.appendChild(child);
    };
    result.text = val => {
        result.innerHTML = val;
    };
    result.attr = val => {
        $.each(val, function(key, isi) {
            result.setAttribute(key, isi);
        });
    };
    result.toHead = () => {
        document.head.appendChild(result);
    };

    result.unset = () => {
        document.body.removeChild(result);
    };
    return result;
};
dim = function(data, runer) {
    app.ready(() => {
        setTimeout(() => {
            $.get(data, jssd => {
                runer(jssd);
            });
        }, 0);
    });
};
async = fun => {
    setTimeout(() => {
        fun();
    }, 0);
};
fsave = (ft, name, type) => {
    var file = new Blob([ft], { type: type });
    if (window.navigator.msSaveOrOpenBlob)
        window.navigator.msSaveBlob(file, name);
    else {
        let a = create("a");
        let url = URL.createObjectURL(file);
        a.href = url;
        a.download = name;
        a.render();
        a.click();
        setTimeout(() => {
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }, 0);
    }
};

style = create({ content: "style", id: "mediaq" });
style.toHead();
style2 = create({ content: "style", id: "dark" });
style2.toHead();

ls = url => {
    $.get(url, data => {
        $("#mediaq").html(data);
    });
};

getText = (url, fun) => {
    let result = "";
    $.get(
        url,
        result2 => {
            result = result2;
            fun(result);
        },
        "text"
    );
    return result;
};

rcss = function(w) {
    let x = [];
    let dark;
    dark = window.matchMedia("(prefers-color-scheme: dark)");
    $.each(w.desktop, (k, v) => {
        x.push([window.matchMedia(v[0]), v[1]]);
    });

    function myFunction() {
        num = false;
        $.each(x, (key, val) => {
            if (val[0].matches) {
                ls(val[1]);
                num = true;
            }
        });
        if (window.screen.orientation.type == "portrait-primary") {
            ls(w.mobile);
        }
        if (dark.matches) {
            getText(w.dark, result => {
                style2.text(result);
            });
        } else {
            style2.text("");
        }
    }

    myFunction();
    $.each(x, (key, val) => {
        val[0].addListener(myFunction);
    });
    dark.addListener(myFunction);
};
gElement = function(param) {
    let temp = $(param);
    temp.child = function(child) {
        temp.append(child);
    };
    temp.attr = val => {
        $.each(val, function(key, isi) {
            temp.attr(key, isi);
        });
    };
    temp.toHead = () => {
        $("head").append(temp);
    };

    temp.unset = () => {
        document.body.removeChild(temp);
    };
    return temp;
};
scope = [];
bind = function(data, nama) {
    let res = [];
    res[0] = nama;
    if (typeof data == "object") {
        $.each(data, (k, v) => {
            if (typeof v == "object") {
                let result = {};
                $.each(v, (k, val) => {
                    result[k] = val;
                });

                res.push(result);
            } else {
                let result = {};
                result[k] = v;
                res.push(result);
            }
        });
    } else res.push(data);

    scope.push(res);
};
include = function(source, data1, target) {
    let body = gElement(target);
    let deta = scope.find(s => s[0] == data1);
    deta.shift();
    $.each(deta, (k, v) => {
        $.get(
            source,
            data => {
                let newdata = data;
                console.log(v);
                $.each(v, (k, val) => {
                    let str = "$scope." + k;
                    newdata = newdata.replace(str, val);
                });
                body.append(newdata);
            },
            "text"
        );
    });
};
let unload = function(v) {
    var head = document.getElementsByTagName("head")[0];
    var body = document.getElementsByTagName("body")[0];
    var scripts = head.getElementsByTagName(v);

    if (scripts.length > 0) {
        head.removeChild(scripts[0]);
        scripts = body.getElementsByTagName(v);

        body.removeChild(scripts[0]);
    }
};