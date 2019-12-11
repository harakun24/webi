var tmmp, tfile, nfile, k;
using = function(url) {
    fetch(url)
        .then(response => response.text())
        .then(response => {
            document.querySelector("head").append("<style>" + response + "</style>");
            // $("head").append("<style>" + response + "</style>");
            console.log("sukses nambah:" + url);
        })
        .catch(err => console.log(err));
};
app = document;
createUI = function(type) {
    let result = document.createElement(type.content);
    for (const [key, val] of Object.entries(type)) {
        if (key == "content") {} else if (key == "css") {
            let sname = "";
            for (const [k, v] of Object.entries(val)) {
                sname += k + ":" + v + "";
            }
            result.setAttribute("style", sname);
        } else if (key == "val") {
            result.append(val);
        } else {
            result.setAttribute(key, val);
        }
    }

    result.render = () => {
        document.body.appendChild(result);
    };
    result.child = child => {
        result.appendChild(child);
    };
    result.attr = val => {
        for (const [key, isi] of Object.entries(val)) {
            result.setAttribute(key, isi);
        }
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
    var ready = callback => {
        if (document.readyState != "loading") callback();
        else document.addEventListener("DOMContentLoaded", callback);
    };

    ready(() => {
        setTimeout(() => {
            fetch(data)
                .then(response => response.json())
                .then(response => {
                    runer(response);
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
        let a = createUI("a");
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

style = createUI({ content: "style", id: "mediaq" });
style.toHead();

ls = url => {
    fetch(url)
        .then(response => response.text())
        .then(response => {
            document.querySelector("#mediaq").innerHTML = response;
        })
        .catch(err => console.log(err));
};

getText = (url, fun) => {
    let result = "";

    fetch(url)
        .then(response => response.text())
        .then(response => {
            result = response;
            fun(result);
        })
        .catch(err => console.log(err));
    return result;
};

rcss = function(w) {
    let x = [];
    for (const [k, v] of Object.entries(w.desktop)) {
        x.push([window.matchMedia(v[0]), v[1]]);
    }

    function myFunction() {
        num = false;
        for (const [key, val] of Object.entries(x)) {
            if (val[0].matches) {
                ls(val[1]);
                num = true;
            }
        }
        if (window.screen.orientation.type == "portrait-primary") {
            ls(w.mobile);
        }
    }

    myFunction();
    for (const [key, val] of Object.entries(x)) {
        val[0].addListener(myFunction);
    }
};
gElement = function(param) {
    let temp = document.querySelector(param);
    temp.child = function(child) {
        temp.append(child);
    };
    temp.attr = val => {
        for (const [key, isi] of Object.entries(val)) {
            temp.attr(key, isi);
        }
    };
    temp.toHead = () => {
        document.querySelector("head").append(temp);
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
        for (const [k, v] of Object.entries(data)) {
            if (typeof v == "object") {
                let result = {};
                for (const [k, val] of Object.entries(v)) {
                    result[k] = val;
                }

                res.push(result);
            } else {
                let result = {};
                result[k] = v;
                res.push(result);
            }
        }
    } else res.push(data);

    scope.push(res);
};
include = function(source, data1, target) {
    let body = gElement(target);
    let deta = scope.find(s => s[0] == data1);
    deta.shift();
    for (const [k, v] of Object.entries(deta)) {
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
        fetch(source)
            .then(response => response.text())
            .then(response => {
                let newdata = response;
                console.log(v);
                for (const [k, val] of Object.entries(v)) {
                    let str = "$scope." + k;
                    newdata = newdata.replace(str, val);
                }
                body.append(newdata);
            });
    }
};