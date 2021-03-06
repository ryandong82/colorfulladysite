(function () {
    var a = this, b = a._, c = {}, d = Array.prototype, e = Object.prototype, f = Function.prototype, g = d.push, h = d.slice, i = d.concat, j = e.toString, k = e.hasOwnProperty, l = d.forEach, m = d.map, n = d.reduce, o = d.reduceRight, p = d.filter, q = d.every, r = d.some, s = d.indexOf, t = d.lastIndexOf, u = Array.isArray, v = Object.keys, w = f.bind, x = function (a) {
        return a instanceof x ? a : this instanceof x ? void(this._wrapped = a) : new x(a)
    };
    "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = x), exports._ = x) : a._ = x, x.VERSION = "1.4.4";
    var y = x.each = x.forEach = function (a, b, d) {
        if (null != a)if (l && a.forEach === l)a.forEach(b, d); else if (a.length === +a.length) {
            for (var e = 0, f = a.length; f > e; e++)if (b.call(d, a[e], e, a) === c)return
        } else for (var g in a)if (x.has(a, g) && b.call(d, a[g], g, a) === c)return
    };
    x.map = x.collect = function (a, b, c) {
        var d = [];
        return null == a ? d : m && a.map === m ? a.map(b, c) : (y(a, function (a, e, f) {
            d[d.length] = b.call(c, a, e, f)
        }), d)
    };
    var z = "Reduce of empty array with no initial value";
    x.reduce = x.foldl = x.inject = function (a, b, c, d) {
        var e = arguments.length > 2;
        if (null == a && (a = []), n && a.reduce === n)return d && (b = x.bind(b, d)), e ? a.reduce(b, c) : a.reduce(b);
        if (y(a, function (a, f, g) {
                e ? c = b.call(d, c, a, f, g) : (c = a, e = !0)
            }), !e)throw new TypeError(z);
        return c
    }, x.reduceRight = x.foldr = function (a, b, c, d) {
        var e = arguments.length > 2;
        if (null == a && (a = []), o && a.reduceRight === o)return d && (b = x.bind(b, d)), e ? a.reduceRight(b, c) : a.reduceRight(b);
        var f = a.length;
        if (f !== +f) {
            var g = x.keys(a);
            f = g.length
        }
        if (y(a, function (h, i, j) {
                i = g ? g[--f] : --f, e ? c = b.call(d, c, a[i], i, j) : (c = a[i], e = !0)
            }), !e)throw new TypeError(z);
        return c
    }, x.find = x.detect = function (a, b, c) {
        var d;
        return A(a, function (a, e, f) {
            return b.call(c, a, e, f) ? (d = a, !0) : void 0
        }), d
    }, x.filter = x.select = function (a, b, c) {
        var d = [];
        return null == a ? d : p && a.filter === p ? a.filter(b, c) : (y(a, function (a, e, f) {
            b.call(c, a, e, f) && (d[d.length] = a)
        }), d)
    }, x.reject = function (a, b, c) {
        return x.filter(a, function (a, d, e) {
            return !b.call(c, a, d, e)
        }, c)
    }, x.every = x.all = function (a, b, d) {
        b || (b = x.identity);
        var e = !0;
        return null == a ? e : q && a.every === q ? a.every(b, d) : (y(a, function (a, f, g) {
            return (e = e && b.call(d, a, f, g)) ? void 0 : c
        }), !!e)
    };
    var A = x.some = x.any = function (a, b, d) {
        b || (b = x.identity);
        var e = !1;
        return null == a ? e : r && a.some === r ? a.some(b, d) : (y(a, function (a, f, g) {
            return e || (e = b.call(d, a, f, g)) ? c : void 0
        }), !!e)
    };
    x.contains = x.include = function (a, b) {
        return null == a ? !1 : s && a.indexOf === s ? -1 != a.indexOf(b) : A(a, function (a) {
            return a === b
        })
    }, x.invoke = function (a, b) {
        var c = h.call(arguments, 2), d = x.isFunction(b);
        return x.map(a, function (a) {
            return (d ? b : a[b]).apply(a, c)
        })
    }, x.pluck = function (a, b) {
        return x.map(a, function (a) {
            return a[b]
        })
    }, x.where = function (a, b, c) {
        return x.isEmpty(b) ? c ? null : [] : x[c ? "find" : "filter"](a, function (a) {
            for (var c in b)if (b[c] !== a[c])return !1;
            return !0
        })
    }, x.findWhere = function (a, b) {
        return x.where(a, b, !0)
    }, x.max = function (a, b, c) {
        if (!b && x.isArray(a) && a[0] === +a[0] && a.length < 65535)return Math.max.apply(Math, a);
        if (!b && x.isEmpty(a))return -1 / 0;
        var d = {computed: -1 / 0, value: -1 / 0};
        return y(a, function (a, e, f) {
            var g = b ? b.call(c, a, e, f) : a;
            g >= d.computed && (d = {value: a, computed: g})
        }), d.value
    }, x.min = function (a, b, c) {
        if (!b && x.isArray(a) && a[0] === +a[0] && a.length < 65535)return Math.min.apply(Math, a);
        if (!b && x.isEmpty(a))return 1 / 0;
        var d = {computed: 1 / 0, value: 1 / 0};
        return y(a, function (a, e, f) {
            var g = b ? b.call(c, a, e, f) : a;
            g < d.computed && (d = {value: a, computed: g})
        }), d.value
    }, x.shuffle = function (a) {
        var b, c = 0, d = [];
        return y(a, function (a) {
            b = x.random(c++), d[c - 1] = d[b], d[b] = a
        }), d
    };
    var B = function (a) {
        return x.isFunction(a) ? a : function (b) {
            return b[a]
        }
    };
    x.sortBy = function (a, b, c) {
        var d = B(b);
        return x.pluck(x.map(a, function (a, b, e) {
            return {value: a, index: b, criteria: d.call(c, a, b, e)}
        }).sort(function (a, b) {
            var c = a.criteria, d = b.criteria;
            if (c !== d) {
                if (c > d || void 0 === c)return 1;
                if (d > c || void 0 === d)return -1
            }
            return a.index < b.index ? -1 : 1
        }), "value")
    };
    var C = function (a, b, c, d) {
        var e = {}, f = B(b || x.identity);
        return y(a, function (b, g) {
            var h = f.call(c, b, g, a);
            d(e, h, b)
        }), e
    };
    x.groupBy = function (a, b, c) {
        return C(a, b, c, function (a, b, c) {
            (x.has(a, b) ? a[b] : a[b] = []).push(c)
        })
    }, x.countBy = function (a, b, c) {
        return C(a, b, c, function (a, b) {
            x.has(a, b) || (a[b] = 0), a[b]++
        })
    }, x.sortedIndex = function (a, b, c, d) {
        c = null == c ? x.identity : B(c);
        for (var e = c.call(d, b), f = 0, g = a.length; g > f;) {
            var h = f + g >>> 1;
            c.call(d, a[h]) < e ? f = h + 1 : g = h
        }
        return f
    }, x.toArray = function (a) {
        return a ? x.isArray(a) ? h.call(a) : a.length === +a.length ? x.map(a, x.identity) : x.values(a) : []
    }, x.size = function (a) {
        return null == a ? 0 : a.length === +a.length ? a.length : x.keys(a).length
    }, x.first = x.head = x.take = function (a, b, c) {
        return null == a ? void 0 : null == b || c ? a[0] : h.call(a, 0, b)
    }, x.initial = function (a, b, c) {
        return h.call(a, 0, a.length - (null == b || c ? 1 : b))
    }, x.last = function (a, b, c) {
        return null == a ? void 0 : null == b || c ? a[a.length - 1] : h.call(a, Math.max(a.length - b, 0))
    }, x.rest = x.tail = x.drop = function (a, b, c) {
        return h.call(a, null == b || c ? 1 : b)
    }, x.compact = function (a) {
        return x.filter(a, x.identity)
    };
    var D = function (a, b, c) {
        return y(a, function (a) {
            x.isArray(a) ? b ? g.apply(c, a) : D(a, b, c) : c.push(a)
        }), c
    };
    x.flatten = function (a, b) {
        return D(a, b, [])
    }, x.without = function (a) {
        return x.difference(a, h.call(arguments, 1))
    }, x.uniq = x.unique = function (a, b, c, d) {
        x.isFunction(b) && (d = c, c = b, b = !1);
        var e = c ? x.map(a, c, d) : a, f = [], g = [];
        return y(e, function (c, d) {
            (b ? d && g[g.length - 1] === c : x.contains(g, c)) || (g.push(c), f.push(a[d]))
        }), f
    }, x.union = function () {
        return x.uniq(i.apply(d, arguments))
    }, x.intersection = function (a) {
        var b = h.call(arguments, 1);
        return x.filter(x.uniq(a), function (a) {
            return x.every(b, function (b) {
                return x.indexOf(b, a) >= 0
            })
        })
    }, x.difference = function (a) {
        var b = i.apply(d, h.call(arguments, 1));
        return x.filter(a, function (a) {
            return !x.contains(b, a)
        })
    }, x.zip = function () {
        for (var a = h.call(arguments), b = x.max(x.pluck(a, "length")), c = new Array(b), d = 0; b > d; d++)c[d] = x.pluck(a, "" + d);
        return c
    }, x.object = function (a, b) {
        if (null == a)return {};
        for (var c = {}, d = 0, e = a.length; e > d; d++)b ? c[a[d]] = b[d] : c[a[d][0]] = a[d][1];
        return c
    }, x.indexOf = function (a, b, c) {
        if (null == a)return -1;
        var d = 0, e = a.length;
        if (c) {
            if ("number" != typeof c)return d = x.sortedIndex(a, b), a[d] === b ? d : -1;
            d = 0 > c ? Math.max(0, e + c) : c
        }
        if (s && a.indexOf === s)return a.indexOf(b, c);
        for (; e > d; d++)if (a[d] === b)return d;
        return -1
    }, x.lastIndexOf = function (a, b, c) {
        if (null == a)return -1;
        var d = null != c;
        if (t && a.lastIndexOf === t)return d ? a.lastIndexOf(b, c) : a.lastIndexOf(b);
        for (var e = d ? c : a.length; e--;)if (a[e] === b)return e;
        return -1
    }, x.range = function (a, b, c) {
        arguments.length <= 1 && (b = a || 0, a = 0), c = arguments[2] || 1;
        for (var d = Math.max(Math.ceil((b - a) / c), 0), e = 0, f = new Array(d); d > e;)f[e++] = a, a += c;
        return f
    }, x.bind = function (a, b) {
        if (a.bind === w && w)return w.apply(a, h.call(arguments, 1));
        var c = h.call(arguments, 2);
        return function () {
            return a.apply(b, c.concat(h.call(arguments)))
        }
    }, x.partial = function (a) {
        var b = h.call(arguments, 1);
        return function () {
            return a.apply(this, b.concat(h.call(arguments)))
        }
    }, x.bindAll = function (a) {
        var b = h.call(arguments, 1);
        return 0 === b.length && (b = x.functions(a)), y(b, function (b) {
            a[b] = x.bind(a[b], a)
        }), a
    }, x.memoize = function (a, b) {
        var c = {};
        return b || (b = x.identity), function () {
            var d = b.apply(this, arguments);
            return x.has(c, d) ? c[d] : c[d] = a.apply(this, arguments)
        }
    }, x.delay = function (a, b) {
        var c = h.call(arguments, 2);
        return setTimeout(function () {
            return a.apply(null, c)
        }, b)
    }, x.defer = function (a) {
        return x.delay.apply(x, [a, 1].concat(h.call(arguments, 1)))
    }, x.throttle = function (a, b) {
        var c, d, e, f, g = 0, h = function () {
            g = new Date, e = null, f = a.apply(c, d)
        };
        return function () {
            var i = new Date, j = b - (i - g);
            return c = this, d = arguments, 0 >= j ? (clearTimeout(e), e = null, g = i, f = a.apply(c, d)) : e || (e = setTimeout(h, j)), f
        }
    }, x.debounce = function (a, b, c) {
        var d, e;
        return function () {
            var f = this, g = arguments, h = function () {
                d = null, c || (e = a.apply(f, g))
            }, i = c && !d;
            return clearTimeout(d), d = setTimeout(h, b), i && (e = a.apply(f, g)), e
        }
    }, x.once = function (a) {
        var b, c = !1;
        return function () {
            return c ? b : (c = !0, b = a.apply(this, arguments), a = null, b)
        }
    }, x.wrap = function (a, b) {
        return function () {
            var c = [a];
            return g.apply(c, arguments), b.apply(this, c)
        }
    }, x.compose = function () {
        var a = arguments;
        return function () {
            for (var b = arguments, c = a.length - 1; c >= 0; c--)b = [a[c].apply(this, b)];
            return b[0]
        }
    }, x.after = function (a, b) {
        return 0 >= a ? b() : function () {
            return --a < 1 ? b.apply(this, arguments) : void 0
        }
    }, x.keys = v || function (a) {
            if (a !== Object(a))throw new TypeError("Invalid object");
            var b = [];
            for (var c in a)x.has(a, c) && (b[b.length] = c);
            return b
        }, x.values = function (a) {
        var b = [];
        for (var c in a)x.has(a, c) && b.push(a[c]);
        return b
    }, x.pairs = function (a) {
        var b = [];
        for (var c in a)x.has(a, c) && b.push([c, a[c]]);
        return b
    }, x.invert = function (a) {
        var b = {};
        for (var c in a)x.has(a, c) && (b[a[c]] = c);
        return b
    }, x.functions = x.methods = function (a) {
        var b = [];
        for (var c in a)x.isFunction(a[c]) && b.push(c);
        return b.sort()
    }, x.extend = function (a) {
        return y(h.call(arguments, 1), function (b) {
            if (b)for (var c in b)a[c] = b[c]
        }), a
    }, x.pick = function (a) {
        var b = {}, c = i.apply(d, h.call(arguments, 1));
        return y(c, function (c) {
            c in a && (b[c] = a[c])
        }), b
    }, x.omit = function (a) {
        var b = {}, c = i.apply(d, h.call(arguments, 1));
        for (var e in a)x.contains(c, e) || (b[e] = a[e]);
        return b
    }, x.defaults = function (a) {
        return y(h.call(arguments, 1), function (b) {
            if (b)for (var c in b)null == a[c] && (a[c] = b[c])
        }), a
    }, x.clone = function (a) {
        return x.isObject(a) ? x.isArray(a) ? a.slice() : x.extend({}, a) : a
    }, x.tap = function (a, b) {
        return b(a), a
    };
    var E = function (a, b, c, d) {
        if (a === b)return 0 !== a || 1 / a == 1 / b;
        if (null == a || null == b)return a === b;
        a instanceof x && (a = a._wrapped), b instanceof x && (b = b._wrapped);
        var e = j.call(a);
        if (e != j.call(b))return !1;
        switch (e) {
            case"[object String]":
                return a == String(b);
            case"[object Number]":
                return a != +a ? b != +b : 0 == a ? 1 / a == 1 / b : a == +b;
            case"[object Date]":
            case"[object Boolean]":
                return +a == +b;
            case"[object RegExp]":
                return a.source == b.source && a.global == b.global && a.multiline == b.multiline && a.ignoreCase == b.ignoreCase
        }
        if ("object" != typeof a || "object" != typeof b)return !1;
        for (var f = c.length; f--;)if (c[f] == a)return d[f] == b;
        c.push(a), d.push(b);
        var g = 0, h = !0;
        if ("[object Array]" == e) {
            if (g = a.length, h = g == b.length)for (; g-- && (h = E(a[g], b[g], c, d)););
        } else {
            var i = a.constructor, k = b.constructor;
            if (i !== k && !(x.isFunction(i) && i instanceof i && x.isFunction(k) && k instanceof k))return !1;
            for (var l in a)if (x.has(a, l) && (g++, !(h = x.has(b, l) && E(a[l], b[l], c, d))))break;
            if (h) {
                for (l in b)if (x.has(b, l) && !g--)break;
                h = !g
            }
        }
        return c.pop(), d.pop(), h
    };
    x.isEqual = function (a, b) {
        return E(a, b, [], [])
    }, x.isEmpty = function (a) {
        if (null == a)return !0;
        if (x.isArray(a) || x.isString(a))return 0 === a.length;
        for (var b in a)if (x.has(a, b))return !1;
        return !0
    }, x.isElement = function (a) {
        return !(!a || 1 !== a.nodeType)
    }, x.isArray = u || function (a) {
            return "[object Array]" == j.call(a)
        }, x.isObject = function (a) {
        return a === Object(a)
    }, y(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function (a) {
        x["is" + a] = function (b) {
            return j.call(b) == "[object " + a + "]"
        }
    }), x.isArguments(arguments) || (x.isArguments = function (a) {
        return !(!a || !x.has(a, "callee"))
    }), "function" != typeof/./ && (x.isFunction = function (a) {
        return "function" == typeof a
    }), x.isFinite = function (a) {
        return isFinite(a) && !isNaN(parseFloat(a))
    }, x.isNaN = function (a) {
        return x.isNumber(a) && a != +a
    }, x.isBoolean = function (a) {
        return a === !0 || a === !1 || "[object Boolean]" == j.call(a)
    }, x.isNull = function (a) {
        return null === a
    }, x.isUndefined = function (a) {
        return void 0 === a
    }, x.has = function (a, b) {
        return k.call(a, b)
    }, x.noConflict = function () {
        return a._ = b, this
    }, x.identity = function (a) {
        return a
    }, x.times = function (a, b, c) {
        for (var d = Array(a), e = 0; a > e; e++)d[e] = b.call(c, e);
        return d
    }, x.random = function (a, b) {
        return null == b && (b = a, a = 0), a + Math.floor(Math.random() * (b - a + 1))
    };
    var F = {escape: {"&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#x27;", "/": "&#x2F;"}};
    F.unescape = x.invert(F.escape);
    var G = {
        escape: new RegExp("[" + x.keys(F.escape).join("") + "]", "g"),
        unescape: new RegExp("(" + x.keys(F.unescape).join("|") + ")", "g")
    };
    x.each(["escape", "unescape"], function (a) {
        x[a] = function (b) {
            return null == b ? "" : ("" + b).replace(G[a], function (b) {
                return F[a][b]
            })
        }
    }), x.result = function (a, b) {
        if (null == a)return null;
        var c = a[b];
        return x.isFunction(c) ? c.call(a) : c
    }, x.mixin = function (a) {
        y(x.functions(a), function (b) {
            var c = x[b] = a[b];
            x.prototype[b] = function () {
                var a = [this._wrapped];
                return g.apply(a, arguments), L.call(this, c.apply(x, a))
            }
        })
    };
    var H = 0;
    x.uniqueId = function (a) {
        var b = ++H + "";
        return a ? a + b : b
    }, x.templateSettings = {evaluate: /<%([\s\S]+?)%>/g, interpolate: /<%=([\s\S]+?)%>/g, escape: /<%-([\s\S]+?)%>/g};
    var I = /(.)^/, J = {
        "'": "'",
        "\\": "\\",
        "\r": "r",
        "\n": "n",
        "	": "t",
        "\u2028": "u2028",
        "\u2029": "u2029"
    }, K = /\\|'|\r|\n|\t|\u2028|\u2029/g;
    x.template = function (a, b, c) {
        if (x.isFunction(a))return b ? a(b) : a;
        var d;
        c = x.defaults({}, c, x.templateSettings);
        var e = new RegExp([(c.escape || I).source, (c.interpolate || I).source, (c.evaluate || I).source].join("|") + "|$", "g"), f = 0, g = "__p+='", h = a;
        a.replace(e, function (b, c, d, e, h) {
            return g += a.slice(f, h).replace(K, function (a) {
                return "\\" + J[a]
            }), c && (g += "'+\n((__t=(" + c + "))==null?'':_.escape(__t))+\n'"), d && (g += "'+\n((__t=(" + d + "))==null?'':__t)+\n'"), e && (g += "';\n" + e + "\n__p+='"), f = h + b.length, b
        }), g += "';\n", c.variable || (g = "with(obj||{}){\n" + g + "}\n"), g = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + g + "return __p;\n";
        try {
            d = new Function(c.variable || "obj", "_", g)
        } catch (i) {
            throw i.source = g, i
        }
        if (b)return d(b, x);
        var j = function (a) {
            return d.call(this, a, x)
        };
        return j.source = "function(" + (c.variable || "obj") + "){\n" + g + "}", j.textsource = h, j
    }, x.chain = function (a) {
        return x(a).chain()
    };
    var L = function (a) {
        return this._chain ? x(a).chain() : a
    };
    x.mixin(x), y(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function (a) {
        var b = d[a];
        x.prototype[a] = function () {
            var c = this._wrapped;
            return b.apply(c, arguments), "shift" != a && "splice" != a || 0 !== c.length || delete c[0], L.call(this, c)
        }
    }), y(["concat", "join", "slice"], function (a) {
        var b = d[a];
        x.prototype[a] = function () {
            return L.call(this, b.apply(this._wrapped, arguments))
        }
    }), x.extend(x.prototype, {
        chain: function () {
            return this._chain = !0, this
        }, value: function () {
            return this._wrapped
        }
    })
}).call(this), function () {
    var a, b = this, c = b.Backbone, d = [], e = d.push, f = d.slice, g = d.splice;
    a = "undefined" != typeof exports ? exports : b.Backbone = {}, a.VERSION = "0.9.10";
    var h = b._;
    h || "undefined" == typeof require || (h = require("underscore")), a.$ = b.jQuery || b.Zepto || b.ender, a.noConflict = function () {
        return b.Backbone = c, this
    }, a.emulateHTTP = !1, a.emulateJSON = !1;
    var i = /\s+/, j = function (a, b, c, d) {
        if (!c)return !0;
        if ("object" == typeof c)for (var e in c)a[b].apply(a, [e, c[e]].concat(d)); else {
            if (!i.test(c))return !0;
            for (var f = c.split(i), g = 0, h = f.length; h > g; g++)a[b].apply(a, [f[g]].concat(d))
        }
    }, k = function (a, b) {
        var c, d = -1, e = a.length;
        switch (b.length) {
            case 0:
                for (; ++d < e;)(c = a[d]).callback.call(c.ctx);
                return;
            case 1:
                for (; ++d < e;)(c = a[d]).callback.call(c.ctx, b[0]);
                return;
            case 2:
                for (; ++d < e;)(c = a[d]).callback.call(c.ctx, b[0], b[1]);
                return;
            case 3:
                for (; ++d < e;)(c = a[d]).callback.call(c.ctx, b[0], b[1], b[2]);
                return;
            default:
                for (; ++d < e;)(c = a[d]).callback.apply(c.ctx, b)
        }
    }, l = a.Events = {
        on: function (a, b, c) {
            if (!j(this, "on", a, [b, c]) || !b)return this;
            this._events || (this._events = {});
            var d = this._events[a] || (this._events[a] = []);
            return d.push({callback: b, context: c, ctx: c || this}), this
        }, once: function (a, b, c) {
            if (!j(this, "once", a, [b, c]) || !b)return this;
            var d = this, e = h.once(function () {
                d.off(a, e), b.apply(this, arguments)
            });
            return e._callback = b, this.on(a, e, c), this
        }, off: function (a, b, c) {
            var d, e, f, g, i, k, l, m;
            if (!this._events || !j(this, "off", a, [b, c]))return this;
            if (!a && !b && !c)return this._events = {}, this;
            for (g = a ? [a] : h.keys(this._events), i = 0, k = g.length; k > i; i++)if (a = g[i], d = this._events[a]) {
                if (f = [], b || c)for (l = 0, m = d.length; m > l; l++)e = d[l], (b && b !== e.callback && b !== e.callback._callback || c && c !== e.context) && f.push(e);
                this._events[a] = f
            }
            return this
        }, trigger: function (a) {
            if (!this._events)return this;
            var b = f.call(arguments, 1);
            if (!j(this, "trigger", a, b))return this;
            var c = this._events[a], d = this._events.all;
            return c && k(c, b), d && k(d, arguments), this
        }, listenTo: function (a, b, c) {
            var d = this._listeners || (this._listeners = {}), e = a._listenerId || (a._listenerId = h.uniqueId("l"));
            return d[e] = a, a.on(b, "object" == typeof b ? this : c, this), this
        }, stopListening: function (a, b, c) {
            var d = this._listeners;
            if (d) {
                if (a)a.off(b, "object" == typeof b ? this : c, this), b || c || delete d[a._listenerId]; else {
                    "object" == typeof b && (c = this);
                    for (var e in d)d[e].off(b, c, this);
                    this._listeners = {}
                }
                return this
            }
        }
    };
    l.bind = l.on, l.unbind = l.off, h.extend(a, l);
    var m = a.Model = function (a, b) {
        var c, d = a || {};
        this.cid = h.uniqueId("c"), this.attributes = {}, b && b.collection && (this.collection = b.collection), b && b.parse && (d = this.parse(d, b) || {}), (c = h.result(this, "defaults")) && (d = h.defaults({}, d, c)), this.set(d, b), this.changed = {}, this.initialize.apply(this, arguments)
    };
    h.extend(m.prototype, l, {
        changed: null, idAttribute: "id", initialize: function () {
        }, toJSON: function () {
            return h.clone(this.attributes)
        }, sync: function () {
            return a.sync.apply(this, arguments)
        }, get: function (a) {
            return this.attributes[a]
        }, escape: function (a) {
            return h.escape(this.get(a))
        }, has: function (a) {
            return null != this.get(a)
        }, set: function (a, b, c) {
            var d, e, f, g, i, j, k, l;
            if (null == a)return this;
            if ("object" == typeof a ? (e = a, c = b) : (e = {})[a] = b, c || (c = {}), !this._validate(e, c))return !1;
            f = c.unset, i = c.silent, g = [], j = this._changing, this._changing = !0, j || (this._previousAttributes = h.clone(this.attributes), this.changed = {}), l = this.attributes, k = this._previousAttributes, this.idAttribute in e && (this.id = e[this.idAttribute]);
            for (d in e)b = e[d], h.isEqual(l[d], b) || g.push(d), h.isEqual(k[d], b) ? delete this.changed[d] : this.changed[d] = b, f ? delete l[d] : l[d] = b;
            if (!i) {
                g.length && (this._pending = !0);
                for (var m = 0, n = g.length; n > m; m++)this.trigger("change:" + g[m], this, l[g[m]], c)
            }
            if (j)return this;
            if (!i)for (; this._pending;)this._pending = !1, this.trigger("change", this, c);
            return this._pending = !1, this._changing = !1, this
        }, unset: function (a, b) {
            return this.set(a, void 0, h.extend({}, b, {unset: !0}))
        }, clear: function (a) {
            var b = {};
            for (var c in this.attributes)b[c] = void 0;
            return this.set(b, h.extend({}, a, {unset: !0}))
        }, hasChanged: function (a) {
            return null == a ? !h.isEmpty(this.changed) : h.has(this.changed, a)
        }, changedAttributes: function (a) {
            if (!a)return this.hasChanged() ? h.clone(this.changed) : !1;
            var b, c = !1, d = this._changing ? this._previousAttributes : this.attributes;
            for (var e in a)h.isEqual(d[e], b = a[e]) || ((c || (c = {}))[e] = b);
            return c
        }, previous: function (a) {
            return null != a && this._previousAttributes ? this._previousAttributes[a] : null
        }, previousAttributes: function () {
            return h.clone(this._previousAttributes)
        }, fetch: function (a) {
            a = a ? h.clone(a) : {}, void 0 === a.parse && (a.parse = !0);
            var b = a.success;
            return a.success = function (a, c, d) {
                return a.set(a.parse(c, d), d) ? void(b && b(a, c, d)) : !1
            }, this.sync("read", this, a)
        }, save: function (a, b, c) {
            var d, e, f, g, i = this.attributes;
            return null == a || "object" == typeof a ? (d = a, c = b) : (d = {})[a] = b, !d || c && c.wait || this.set(d, c) ? (c = h.extend({validate: !0}, c), this._validate(d, c) ? (d && c.wait && (this.attributes = h.extend({}, i, d)), void 0 === c.parse && (c.parse = !0), e = c.success, c.success = function (a, b, c) {
                a.attributes = i;
                var f = a.parse(b, c);
                return c.wait && (f = h.extend(d || {}, f)), h.isObject(f) && !a.set(f, c) ? !1 : void(e && e(a, b, c))
            }, f = this.isNew() ? "create" : c.patch ? "patch" : "update", "patch" === f && (c.attrs = d), g = this.sync(f, this, c), d && c.wait && (this.attributes = i), g) : !1) : !1
        }, destroy: function (a) {
            a = a ? h.clone(a) : {};
            var b = this, c = a.success, d = function () {
                b.trigger("destroy", b, b.collection, a)
            };
            if (a.success = function (a, b, e) {
                    (e.wait || a.isNew()) && d(), c && c(a, b, e)
                }, this.isNew())return a.success(this, null, a), !1;
            var e = this.sync("delete", this, a);
            return a.wait || d(), e
        }, url: function () {
            var a = h.result(this, "urlRoot") || h.result(this.collection, "url") || F();
            return this.isNew() ? a : a + ("/" === a.charAt(a.length - 1) ? "" : "/") + encodeURIComponent(this.id)
        }, parse: function (a) {
            return a
        }, clone: function () {
            return new this.constructor(this.attributes)
        }, isNew: function () {
            return null == this.id
        }, isValid: function (a) {
            return !this.validate || !this.validate(this.attributes, a)
        }, _validate: function (a, b) {
            if (!b.validate || !this.validate)return !0;
            a = h.extend({}, this.attributes, a);
            var c = this.validationError = this.validate(a, b) || null;
            return c ? (this.trigger("invalid", this, c, b || {}), !1) : !0
        }
    });
    var n = a.Collection = function (a, b) {
        b || (b = {}), b.model && (this.model = b.model), void 0 !== b.comparator && (this.comparator = b.comparator), this.models = [], this._reset(), this.initialize.apply(this, arguments), a && this.reset(a, h.extend({silent: !0}, b))
    };
    h.extend(n.prototype, l, {
        model: m, initialize: function () {
        }, toJSON: function (a) {
            return this.map(function (b) {
                return b.toJSON(a)
            })
        }, sync: function () {
            return a.sync.apply(this, arguments)
        }, add: function (a, b) {
            a = h.isArray(a) ? a.slice() : [a], b || (b = {});
            var c, d, f, i, j, k, l, m, n, o;
            for (l = [], m = b.at, n = this.comparator && null == m && 0 != b.sort, o = h.isString(this.comparator) ? this.comparator : null, c = 0, d = a.length; d > c; c++)(f = this._prepareModel(i = a[c], b)) ? (j = this.get(f)) ? b.merge && (j.set(i === f ? f.attributes : i, b), n && !k && j.hasChanged(o) && (k = !0)) : (l.push(f), f.on("all", this._onModelEvent, this), this._byId[f.cid] = f, null != f.id && (this._byId[f.id] = f)) : this.trigger("invalid", this, i, b);
            if (l.length && (n && (k = !0), this.length += l.length, null != m ? g.apply(this.models, [m, 0].concat(l)) : e.apply(this.models, l)), k && this.sort({silent: !0}), b.silent)return this;
            for (c = 0, d = l.length; d > c; c++)(f = l[c]).trigger("add", f, this, b);
            return k && this.trigger("sort", this, b), this
        }, remove: function (a, b) {
            a = h.isArray(a) ? a.slice() : [a], b || (b = {});
            var c, d, e, f;
            for (c = 0, d = a.length; d > c; c++)f = this.get(a[c]), f && (delete this._byId[f.id], delete this._byId[f.cid], e = this.indexOf(f), this.models.splice(e, 1), this.length--, b.silent || (b.index = e, f.trigger("remove", f, this, b)), this._removeReference(f));
            return this
        }, push: function (a, b) {
            return a = this._prepareModel(a, b), this.add(a, h.extend({at: this.length}, b)), a
        }, pop: function (a) {
            var b = this.at(this.length - 1);
            return this.remove(b, a), b
        }, unshift: function (a, b) {
            return a = this._prepareModel(a, b), this.add(a, h.extend({at: 0}, b)), a
        }, shift: function (a) {
            var b = this.at(0);
            return this.remove(b, a), b
        }, slice: function (a, b) {
            return this.models.slice(a, b)
        }, get: function (a) {
            return null == a ? void 0 : (this._idAttr || (this._idAttr = this.model.prototype.idAttribute), this._byId[a.id || a.cid || a[this._idAttr] || a])
        }, at: function (a) {
            return this.models[a]
        }, where: function (a) {
            return h.isEmpty(a) ? [] : this.filter(function (b) {
                for (var c in a)if (a[c] !== b.get(c))return !1;
                return !0
            })
        }, sort: function (a) {
            if (!this.comparator)throw new Error("Cannot sort a set without a comparator");
            return a || (a = {}), h.isString(this.comparator) || 1 === this.comparator.length ? this.models = this.sortBy(this.comparator, this) : this.models.sort(h.bind(this.comparator, this)), a.silent || this.trigger("sort", this, a), this
        }, pluck: function (a) {
            return h.invoke(this.models, "get", a)
        }, update: function (a, b) {
            b = h.extend({add: !0, merge: !0, remove: !0}, b), b.parse && (a = this.parse(a, b));
            var c, d, e, f, g = [], i = [], j = {};
            if (h.isArray(a) || (a = a ? [a] : []), b.add && !b.remove)return this.add(a, b);
            for (d = 0, e = a.length; e > d; d++)c = a[d], f = this.get(c), b.remove && f && (j[f.cid] = !0), (b.add && !f || b.merge && f) && g.push(c);
            if (b.remove)for (d = 0, e = this.models.length; e > d; d++)c = this.models[d], j[c.cid] || i.push(c);
            return i.length && this.remove(i, b), g.length && this.add(g, b), this
        }, reset: function (a, b) {
            b || (b = {}), b.parse && (a = this.parse(a, b));
            for (var c = 0, d = this.models.length; d > c; c++)this._removeReference(this.models[c]);
            return b.previousModels = this.models.slice(), this._reset(), a && this.add(a, h.extend({silent: !0}, b)), b.silent || this.trigger("reset", this, b), this
        }, fetch: function (a) {
            a = a ? h.clone(a) : {}, void 0 === a.parse && (a.parse = !0);
            var b = a.success;
            return a.success = function (a, c, d) {
                var e = d.update ? "update" : "reset";
                a[e](c, d), b && b(a, c, d)
            }, this.sync("read", this, a)
        }, create: function (a, b) {
            if (b = b ? h.clone(b) : {}, !(a = this._prepareModel(a, b)))return !1;
            b.wait || this.add(a, b);
            var c = this, d = b.success;
            return b.success = function (a, b, e) {
                e.wait && c.add(a, e), d && d(a, b, e)
            }, a.save(null, b), a
        }, parse: function (a) {
            return a
        }, clone: function () {
            return new this.constructor(this.models)
        }, _reset: function () {
            this.length = 0, this.models.length = 0, this._byId = {}
        }, _prepareModel: function (a, b) {
            if (a instanceof m)return a.collection || (a.collection = this), a;
            b || (b = {}), b.collection = this;
            var c = new this.model(a, b);
            return c._validate(a, b) ? c : !1
        }, _removeReference: function (a) {
            this === a.collection && delete a.collection, a.off("all", this._onModelEvent, this)
        }, _onModelEvent: function (a, b, c, d) {
            ("add" !== a && "remove" !== a || c === this) && ("destroy" === a && this.remove(b, d), b && a === "change:" + b.idAttribute && (delete this._byId[b.previous(b.idAttribute)], null != b.id && (this._byId[b.id] = b)), this.trigger.apply(this, arguments))
        }, sortedIndex: function (a, b, c) {
            b || (b = this.comparator);
            var d = h.isFunction(b) ? b : function (a) {
                return a.get(b)
            };
            return h.sortedIndex(this.models, a, d, c)
        }
    });
    var o = ["forEach", "each", "map", "collect", "reduce", "foldl", "inject", "reduceRight", "foldr", "find", "detect", "filter", "select", "reject", "every", "all", "some", "any", "include", "contains", "invoke", "max", "min", "toArray", "size", "first", "head", "take", "initial", "rest", "tail", "drop", "last", "without", "indexOf", "shuffle", "lastIndexOf", "isEmpty", "chain"];
    h.each(o, function (a) {
        n.prototype[a] = function () {
            var b = f.call(arguments);
            return b.unshift(this.models), h[a].apply(h, b)
        }
    });
    var p = ["groupBy", "countBy", "sortBy"];
    h.each(p, function (a) {
        n.prototype[a] = function (b, c) {
            var d = h.isFunction(b) ? b : function (a) {
                return a.get(b)
            };
            return h[a](this.models, d, c)
        }
    });
    var q = a.Router = function (a) {
        a || (a = {}), a.routes && (this.routes = a.routes), this._bindRoutes(), this.initialize.apply(this, arguments)
    }, r = /\((.*?)\)/g, s = /(\(\?)?:\w+/g, t = /\*\w+/g, u = /[\-{}\[\]+?.,\\\^$|#\s]/g;
    h.extend(q.prototype, l, {
        initialize: function () {
        }, route: function (b, c, d) {
            return h.isRegExp(b) || (b = this._routeToRegExp(b)), d || (d = this[c]), a.history.route(b, h.bind(function (e) {
                var f = this._extractParameters(b, e);
                d && d.apply(this, f), this.trigger.apply(this, ["route:" + c].concat(f)), this.trigger("route", c, f), a.history.trigger("route", this, c, f)
            }, this)), this
        }, navigate: function (b, c) {
            return a.history.navigate(b, c), this
        }, _bindRoutes: function () {
            if (this.routes)for (var a, b = h.keys(this.routes); null != (a = b.pop());)this.route(a, this.routes[a])
        }, _routeToRegExp: function (a) {
            return a = a.replace(u, "\\$&").replace(r, "(?:$1)?").replace(s, function (a, b) {
                return b ? a : "([^/]+)"
            }).replace(t, "(.*?)"), new RegExp("^" + a + "$")
        }, _extractParameters: function (a, b) {
            return a.exec(b).slice(1)
        }
    });
    var v = a.History = function () {
        this.handlers = [], h.bindAll(this, "checkUrl"), "undefined" != typeof window && (this.location = window.location, this.history = window.history)
    }, w = /^[#\/]|\s+$/g, x = /^\/+|\/+$/g, y = /msie [\w.]+/, z = /\/$/;
    v.started = !1, h.extend(v.prototype, l, {
        interval: 50, getHash: function (a) {
            var b = (a || this).location.href.match(/#(.*)$/);
            return b ? b[1] : ""
        }, getFragment: function (a, b) {
            if (null == a)if (this._hasPushState || !this._wantsHashChange || b) {
                a = this.location.pathname;
                var c = this.root.replace(z, "");
                a.indexOf(c) || (a = a.substr(c.length))
            } else a = this.getHash();
            return a.replace(w, "")
        }, start: function (b) {
            if (v.started)throw new Error("Backbone.history has already been started");
            v.started = !0, this.options = h.extend({}, {root: "/"}, this.options, b), this.root = this.options.root, this._wantsHashChange = this.options.hashChange !== !1, this._wantsPushState = !!this.options.pushState, this._hasPushState = !!(this.options.pushState && this.history && this.history.pushState);
            var c = this.getFragment(), d = document.documentMode, e = y.exec(navigator.userAgent.toLowerCase()) && (!d || 7 >= d);
            this.root = ("/" + this.root + "/").replace(x, "/"), e && this._wantsHashChange && (this.iframe = a.$('<iframe src="javascript:0" tabindex="-1" />').hide().appendTo("body")[0].contentWindow, this.navigate(c)), this._hasPushState ? a.$(window).on("popstate", this.checkUrl) : this._wantsHashChange && "onhashchange" in window && !e ? a.$(window).on("hashchange", this.checkUrl) : this._wantsHashChange && (this._checkUrlInterval = setInterval(this.checkUrl, this.interval)), this.fragment = c;
            var f = this.location, g = f.pathname.replace(/[^\/]$/, "$&/") === this.root;
            return this._wantsHashChange && this._wantsPushState && !this._hasPushState && !g ? (this.fragment = this.getFragment(null, !0), this.location.replace(this.root + this.location.search + "#" + this.fragment), !0) : (this._wantsPushState && this._hasPushState && g && f.hash && (this.fragment = this.getHash().replace(w, ""), this.history.replaceState({}, document.title, this.root + this.fragment + f.search)), this.options.silent ? void 0 : this.loadUrl())
        }, stop: function () {
            a.$(window).off("popstate", this.checkUrl).off("hashchange", this.checkUrl), clearInterval(this._checkUrlInterval), v.started = !1
        }, route: function (a, b) {
            this.handlers.unshift({route: a, callback: b})
        }, checkUrl: function () {
            var a = this.getFragment();
            return a === this.fragment && this.iframe && (a = this.getFragment(this.getHash(this.iframe))), a === this.fragment ? !1 : (this.iframe && this.navigate(a), void(this.loadUrl() || this.loadUrl(this.getHash())))
        }, loadUrl: function (a) {
            var b = this.fragment = this.getFragment(a), c = h.any(this.handlers, function (a) {
                return a.route.test(b) ? (a.callback(b), !0) : void 0
            });
            return c
        }, navigate: function (a, b) {
            if (!v.started)return !1;
            if (b && b !== !0 || (b = {trigger: b}), a = this.getFragment(a || ""), this.fragment !== a) {
                this.fragment = a;
                var c = this.root + a;
                if (this._hasPushState)this.history[b.replace ? "replaceState" : "pushState"]({}, document.title, c); else {
                    if (!this._wantsHashChange)return this.location.assign(c);
                    this._updateHash(this.location, a, b.replace), this.iframe && a !== this.getFragment(this.getHash(this.iframe)) && (b.replace || this.iframe.document.open().close(), this._updateHash(this.iframe.location, a, b.replace))
                }
                b.trigger && this.loadUrl(a)
            }
        }, _updateHash: function (a, b, c) {
            if (c) {
                var d = a.href.replace(/(javascript:|#).*$/, "");
                a.replace(d + "#" + b)
            } else a.hash = "#" + b
        }
    }), a.history = new v;
    var A = a.View = function (a) {
        this.cid = h.uniqueId("view"), this._configure(a || {}), this._ensureElement(), this.initialize.apply(this, arguments), this.delegateEvents()
    }, B = /^(\S+)\s*(.*)$/, C = ["model", "collection", "el", "id", "attributes", "className", "tagName", "events"];
    h.extend(A.prototype, l, {
        tagName: "div", $: function (a) {
            return this.$el.find(a)
        }, initialize: function () {
        }, render: function () {
            return this
        }, remove: function () {
            return this.$el.remove(), this.stopListening(), this
        }, setElement: function (b, c) {
            return this.$el && this.undelegateEvents(), this.$el = b instanceof a.$ ? b : a.$(b), this.el = this.$el[0], c !== !1 && this.delegateEvents(), this
        }, delegateEvents: function (a) {
            if (a || (a = h.result(this, "events"))) {
                this.undelegateEvents();
                for (var b in a) {
                    var c = a[b];
                    if (h.isFunction(c) || (c = this[a[b]]), !c)throw new Error('Method "' + a[b] + '" does not exist');
                    var d = b.match(B), e = d[1], f = d[2];
                    c = h.bind(c, this), e += ".delegateEvents" + this.cid, "" === f ? this.$el.on(e, c) : this.$el.on(e, f, c)
                }
            }
        }, undelegateEvents: function () {
            this.$el.off(".delegateEvents" + this.cid)
        }, _configure: function (a) {
            this.options && (a = h.extend({}, h.result(this, "options"), a)), h.extend(this, h.pick(a, C)), this.options = a
        }, _ensureElement: function () {
            if (this.el)this.setElement(h.result(this, "el"), !1); else {
                var b = h.extend({}, h.result(this, "attributes"));
                this.id && (b.id = h.result(this, "id")), this.className && (b["class"] = h.result(this, "className"));
                var c = a.$("<" + h.result(this, "tagName") + ">").attr(b);
                this.setElement(c, !1)
            }
        }
    });
    var D = {create: "POST", update: "PUT", patch: "PATCH", "delete": "DELETE", read: "GET"};
    a.sync = function (b, c, d) {
        var e = D[b];
        h.defaults(d || (d = {}), {emulateHTTP: a.emulateHTTP, emulateJSON: a.emulateJSON});
        var f = {type: e, dataType: "json"};
        if (d.url || (f.url = h.result(c, "url") || F()), null != d.data || !c || "create" !== b && "update" !== b && "patch" !== b || (f.contentType = "application/json", f.data = JSON.stringify(d.attrs || c.toJSON(d))), d.emulateJSON && (f.contentType = "application/x-www-form-urlencoded", f.data = f.data ? {model: f.data} : {}), d.emulateHTTP && ("PUT" === e || "DELETE" === e || "PATCH" === e)) {
            f.type = "POST", d.emulateJSON && (f.data._method = e);
            var g = d.beforeSend;
            d.beforeSend = function (a) {
                return a.setRequestHeader("X-HTTP-Method-Override", e), g ? g.apply(this, arguments) : void 0
            }
        }
        "GET" === f.type || d.emulateJSON || (f.processData = !1);
        var i = d.success;
        d.success = function (a) {
            i && i(c, a, d), c.trigger("sync", c, a, d)
        };
        var j = d.error;
        d.error = function (a) {
            j && j(c, a, d), c.trigger("error", c, a, d)
        };
        var k = d.xhr = a.ajax(h.extend(f, d));
        return c.trigger("request", c, k, d), k
    }, a.ajax = function () {
        return a.$.ajax.apply(a.$, arguments)
    };
    var E = function (a, b) {
        var c, d = this;
        c = a && h.has(a, "constructor") ? a.constructor : function () {
            return d.apply(this, arguments)
        }, h.extend(c, d, b);
        var e = function () {
            this.constructor = c
        };
        return e.prototype = d.prototype, c.prototype = new e, a && h.extend(c.prototype, a), c.__super__ = d.prototype, c
    };
    m.extend = n.extend = q.extend = A.extend = v.extend = E;
    var F = function () {
        throw new Error('A "url" property or function must be specified')
    }
}.call(this), function (a, b) {
    "use strict";
    function c() {
        d.READY || (d.event.determineEventTypes(), d.utils.each(d.gestures, function (a) {
            d.detection.register(a)
        }), d.event.onTouch(d.DOCUMENT, d.EVENT_MOVE, d.detection.detect), d.event.onTouch(d.DOCUMENT, d.EVENT_END, d.detection.detect), d.READY = !0)
    }

    var d = function (a, b) {
        return new d.Instance(a, b || {})
    };
    d.defaults = {
        stop_browser_behavior: {
            userSelect: "none",
            touchAction: "none",
            touchCallout: "none",
            contentZooming: "none",
            userDrag: "none",
            tapHighlightColor: "rgba(0,0,0,0)"
        }
    }, d.HAS_POINTEREVENTS = a.navigator.pointerEnabled || a.navigator.msPointerEnabled, d.HAS_TOUCHEVENTS = "ontouchstart" in a, d.MOBILE_REGEX = /mobile|tablet|ip(ad|hone|od)|android|silk/i, d.NO_MOUSEEVENTS = d.HAS_TOUCHEVENTS && a.navigator.userAgent.match(d.MOBILE_REGEX), d.EVENT_TYPES = {}, d.DIRECTION_DOWN = "down", d.DIRECTION_LEFT = "left", d.DIRECTION_UP = "up", d.DIRECTION_RIGHT = "right", d.POINTER_MOUSE = "mouse", d.POINTER_TOUCH = "touch", d.POINTER_PEN = "pen", d.EVENT_START = "start", d.EVENT_MOVE = "move", d.EVENT_END = "end", d.DOCUMENT = a.document, d.plugins = d.plugins || {}, d.gestures = d.gestures || {}, d.READY = !1, d.utils = {
        extend: function (a, c, d) {
            for (var e in c)a[e] !== b && d || (a[e] = c[e]);
            return a
        }, each: function (a, c, d) {
            var e, f;
            if ("forEach" in a)a.forEach(c, d); else if (a.length !== b) {
                for (e = 0, f = a.length; f > e; e++)if (c.call(d, a[e], e, a) === !1)return
            } else for (e in a)if (a.hasOwnProperty(e) && c.call(d, a[e], e, a) === !1)return
        }, hasParent: function (a, b) {
            for (; a;) {
                if (a == b)return !0;
                a = a.parentNode
            }
            return !1
        }, getCenter: function (a) {
            var b = [], c = [];
            return d.utils.each(a, function (a) {
                b.push("undefined" != typeof a.clientX ? a.clientX : a.pageX), c.push("undefined" != typeof a.clientY ? a.clientY : a.pageY)
            }), {
                pageX: (Math.min.apply(Math, b) + Math.max.apply(Math, b)) / 2,
                pageY: (Math.min.apply(Math, c) + Math.max.apply(Math, c)) / 2
            }
        }, getVelocity: function (a, b, c) {
            return {x: Math.abs(b / a) || 0, y: Math.abs(c / a) || 0}
        }, getAngle: function (a, b) {
            var c = b.pageY - a.pageY, d = b.pageX - a.pageX;
            return 180 * Math.atan2(c, d) / Math.PI
        }, getDirection: function (a, b) {
            var c = Math.abs(a.pageX - b.pageX), e = Math.abs(a.pageY - b.pageY);
            return c >= e ? a.pageX - b.pageX > 0 ? d.DIRECTION_LEFT : d.DIRECTION_RIGHT : a.pageY - b.pageY > 0 ? d.DIRECTION_UP : d.DIRECTION_DOWN
        }, getDistance: function (a, b) {
            var c = b.pageX - a.pageX, d = b.pageY - a.pageY;
            return Math.sqrt(c * c + d * d)
        }, getScale: function (a, b) {
            return a.length >= 2 && b.length >= 2 ? this.getDistance(b[0], b[1]) / this.getDistance(a[0], a[1]) : 1
        }, getRotation: function (a, b) {
            return a.length >= 2 && b.length >= 2 ? this.getAngle(b[1], b[0]) - this.getAngle(a[1], a[0]) : 0
        }, isVertical: function (a) {
            return a == d.DIRECTION_UP || a == d.DIRECTION_DOWN
        }, stopDefaultBrowserBehavior: function (a, b) {
            b && a && a.style && (d.utils.each(["webkit", "khtml", "moz", "Moz", "ms", "o", ""], function (c) {
                d.utils.each(b, function (b, d) {
                    c && (d = c + d.substring(0, 1).toUpperCase() + d.substring(1)), d in a.style && (a.style[d] = b)
                })
            }), "none" == b.userSelect && (a.onselectstart = function () {
                return !1
            }), "none" == b.userDrag && (a.ondragstart = function () {
                return !1
            }))
        }
    }, d.Instance = function (a, b) {
        var e = this;
        return c(), this.element = a, this.enabled = !0, this.options = d.utils.extend(d.utils.extend({}, d.defaults), b || {}), this.options.stop_browser_behavior && d.utils.stopDefaultBrowserBehavior(this.element, this.options.stop_browser_behavior), d.event.onTouch(a, d.EVENT_START, function (a) {
            e.enabled && d.detection.startDetect(e, a)
        }), this
    }, d.Instance.prototype = {
        on: function (a, b) {
            var c = a.split(" ");
            return d.utils.each(c, function (a) {
                this.element.addEventListener(a, b, !1)
            }, this), this
        }, off: function (a, b) {
            var c = a.split(" ");
            return d.utils.each(c, function (a) {
                this.element.removeEventListener(a, b, !1)
            }, this), this
        }, trigger: function (a, b) {
            b || (b = {});
            var c = d.DOCUMENT.createEvent("Event");
            c.initEvent(a, !0, !0), c.gesture = b;
            var e = this.element;
            return d.utils.hasParent(b.target, e) && (e = b.target), e.dispatchEvent(c), this
        }, enable: function (a) {
            return this.enabled = a, this
        }, reset: function () {
            e = null, f = !1, g = !1, d.PointerEvent.reset()
        }
    };
    var e = null, f = !1, g = !1;
    d.event = {
        bindDom: function (a, b, c) {
            var e = b.split(" ");
            d.utils.each(e, function (b) {
                a.addEventListener(b, c, !1)
            })
        }, onTouch: function (a, b, c) {
            var h = this;
            this.bindDom(a, d.EVENT_TYPES[b], function (i) {
                var j = i.type.toLowerCase();
                if (!j.match(/mouse/) || !g) {
                    j.match(/touch/) || j.match(/pointerdown/) || j.match(/mouse/) && 1 === i.which ? f = !0 : j.match(/mouse/) && !i.which && (f = !1), j.match(/touch|pointer/) && (g = !0);
                    var k = 0;
                    f && (d.HAS_POINTEREVENTS && b != d.EVENT_END ? k = d.PointerEvent.updatePointer(b, i) : j.match(/touch/) ? k = i.touches.length : g || (k = j.match(/up/) ? 0 : 1), k > 0 && b == d.EVENT_END ? b = d.EVENT_MOVE : k || (b = d.EVENT_END), (k || null === e) && (e = i), c.call(d.detection, h.collectEventData(a, b, h.getTouchList(e, b), i)), d.HAS_POINTEREVENTS && b == d.EVENT_END && (k = d.PointerEvent.updatePointer(b, i))), k || (e = null, f = !1, g = !1, d.PointerEvent.reset())
                }
            })
        }, determineEventTypes: function () {
            var a;
            a = d.HAS_POINTEREVENTS ? d.PointerEvent.getEvents() : d.NO_MOUSEEVENTS ? ["touchstart", "touchmove", "touchend touchcancel"] : ["touchstart mousedown", "touchmove mousemove", "touchend touchcancel mouseup"], d.EVENT_TYPES[d.EVENT_START] = a[0], d.EVENT_TYPES[d.EVENT_MOVE] = a[1], d.EVENT_TYPES[d.EVENT_END] = a[2]
        }, getTouchList: function (a) {
            return d.HAS_POINTEREVENTS ? d.PointerEvent.getTouchList() : a.touches ? a.touches : (a.identifier = 1, [a])
        }, collectEventData: function (a, b, c, e) {
            var f = d.POINTER_TOUCH;
            return (e.type.match(/mouse/) || d.PointerEvent.matchType(d.POINTER_MOUSE, e)) && (f = d.POINTER_MOUSE), {
                center: d.utils.getCenter(c),
                timeStamp: (new Date).getTime(),
                target: e.target,
                touches: c,
                eventType: b,
                pointerType: f,
                srcEvent: e,
                preventDefault: function () {
                    this.srcEvent.preventManipulation && this.srcEvent.preventManipulation(), this.srcEvent.preventDefault && this.srcEvent.preventDefault()
                },
                stopPropagation: function () {
                    this.srcEvent.stopPropagation()
                },
                stopDetect: function () {
                    return d.detection.stopDetect()
                }
            }
        }
    }, d.PointerEvent = {
        pointers: {}, getTouchList: function () {
            var a = this, b = [];
            return d.utils.each(a.pointers, function (a) {
                b.push(a)
            }), b
        }, updatePointer: function (a, b) {
            return a == d.EVENT_END ? this.pointers = {} : (b.identifier = b.pointerId, this.pointers[b.pointerId] = b), Object.keys(this.pointers).length
        }, matchType: function (a, b) {
            if (!b.pointerType)return !1;
            var c = b.pointerType, e = {};
            return e[d.POINTER_MOUSE] = c === b.MSPOINTER_TYPE_MOUSE || c === d.POINTER_MOUSE, e[d.POINTER_TOUCH] = c === b.MSPOINTER_TYPE_TOUCH || c === d.POINTER_TOUCH, e[d.POINTER_PEN] = c === b.MSPOINTER_TYPE_PEN || c === d.POINTER_PEN, e[a]
        }, getEvents: function () {
            return ["pointerdown MSPointerDown", "pointermove MSPointerMove", "pointerup pointercancel MSPointerUp MSPointerCancel"]
        }, reset: function () {
            this.pointers = {}
        }
    }, d.detection = {
        gestures: [], current: null, previous: null, stopped: !1, startDetect: function (a, b) {
            this.current || (this.stopped = !1, this.current = {
                inst: a,
                startEvent: d.utils.extend({}, b),
                lastEvent: !1,
                name: ""
            }, this.detect(b))
        }, detect: function (a) {
            if (this.current && !this.stopped) {
                a = this.extendEventData(a);
                var b = this.current.inst.options;
                return d.utils.each(this.gestures, function (c) {
                    return this.stopped || b[c.name] === !1 || c.handler.call(c, a, this.current.inst) !== !1 ? void 0 : (this.stopDetect(), !1)
                }, this), this.current && (this.current.lastEvent = a), a.eventType == d.EVENT_END && !a.touches.length - 1 && this.stopDetect(), a
            }
        }, stopDetect: function () {
            this.previous = d.utils.extend({}, this.current), this.current = null, this.stopped = !0
        }, extendEventData: function (a) {
            var b = this.current.startEvent;
            !b || a.touches.length == b.touches.length && a.touches !== b.touches || (b.touches = [], d.utils.each(a.touches, function (a) {
                b.touches.push(d.utils.extend({}, a))
            }));
            var c, e, f = a.timeStamp - b.timeStamp, g = a.center.pageX - b.center.pageX, h = a.center.pageY - b.center.pageY, i = d.utils.getVelocity(f, g, h);
            return "end" === a.eventType ? (c = this.current.lastEvent && this.current.lastEvent.interimAngle, e = this.current.lastEvent && this.current.lastEvent.interimDirection) : (c = this.current.lastEvent && d.utils.getAngle(this.current.lastEvent.center, a.center), e = this.current.lastEvent && d.utils.getDirection(this.current.lastEvent.center, a.center)), d.utils.extend(a, {
                deltaTime: f,
                deltaX: g,
                deltaY: h,
                velocityX: i.x,
                velocityY: i.y,
                distance: d.utils.getDistance(b.center, a.center),
                angle: d.utils.getAngle(b.center, a.center),
                interimAngle: c,
                direction: d.utils.getDirection(b.center, a.center),
                interimDirection: e,
                scale: d.utils.getScale(b.touches, a.touches),
                rotation: d.utils.getRotation(b.touches, a.touches),
                startEvent: b
            }), a
        }, register: function (a) {
            var c = a.defaults || {};
            return c[a.name] === b && (c[a.name] = !0), d.utils.extend(d.defaults, c, !0), a.index = a.index || 1e3, this.gestures.push(a), this.gestures.sort(function (a, b) {
                return a.index < b.index ? -1 : a.index > b.index ? 1 : 0
            }), this.gestures
        }
    }, d.gestures.Drag = {
        name: "drag",
        index: 50,
        defaults: {
            drag_min_distance: -1 !== a.navigator.userAgent.toLowerCase().indexOf("android") ? 5 : 10,
            correct_for_drag_min_distance: !0,
            drag_max_touches: 1,
            drag_block_horizontal: !1,
            drag_block_vertical: !1,
            drag_lock_to_axis: !1,
            drag_lock_min_distance: 25
        },
        triggered: !1,
        handler: function (a, b) {
            if (d.detection.current && d.detection.current.name != this.name && this.triggered)return b.trigger(this.name + "end", a), void(this.triggered = !1);
            if (!(b.options.drag_max_touches > 0 && a.touches.length > b.options.drag_max_touches))switch (a.eventType) {
                case d.EVENT_START:
                    this.triggered = !1;
                    break;
                case d.EVENT_MOVE:
                    if (a.distance < b.options.drag_min_distance && d.detection.current.name != this.name)return;
                    if (d.detection.current.name != this.name && (d.detection.current.name = this.name, b.options.correct_for_drag_min_distance && a.distance > 0)) {
                        var c = Math.abs(b.options.drag_min_distance / a.distance);
                        d.detection.current.startEvent.center.pageX += a.deltaX * c, d.detection.current.startEvent.center.pageY += a.deltaY * c, a = d.detection.extendEventData(a)
                    }
                    (d.detection.current.lastEvent.drag_locked_to_axis || b.options.drag_lock_to_axis && b.options.drag_lock_min_distance <= a.distance) && (a.drag_locked_to_axis = !0);
                    var e = d.detection.current.lastEvent.direction;
                    a.drag_locked_to_axis && e !== a.direction && (a.direction = d.utils.isVertical(e) ? a.deltaY < 0 ? d.DIRECTION_UP : d.DIRECTION_DOWN : a.deltaX < 0 ? d.DIRECTION_LEFT : d.DIRECTION_RIGHT), this.triggered || (b.trigger(this.name + "start", a), this.triggered = !0), b.trigger(this.name, a), b.trigger(this.name + a.direction, a), (b.options.drag_block_vertical && d.utils.isVertical(a.direction) || b.options.drag_block_horizontal && !d.utils.isVertical(a.direction)) && a.preventDefault();
                    break;
                case d.EVENT_END:
                    this.triggered && b.trigger(this.name + "end", a), this.triggered = !1
            }
        }
    }, d.gestures.Hold = {
        name: "hold",
        index: 10,
        defaults: {hold_timeout: 800, hold_threshold: 1},
        timer: null,
        handler: function (a, b) {
            switch (a.eventType) {
                case d.EVENT_START:
                    clearTimeout(this.timer), d.detection.current.name = this.name, this.timer = setTimeout(function () {
                        d.detection.current && "hold" == d.detection.current.name && b.trigger("hold", a)
                    }, b.options.hold_timeout);
                    break;
                case d.EVENT_MOVE:
                    a.distance > b.options.hold_threshold && clearTimeout(this.timer);
                    break;
                case d.EVENT_END:
                    clearTimeout(this.timer)
            }
        }
    }, d.gestures.Release = {
        name: "release", index: 1 / 0, handler: function (a, b) {
            a.eventType == d.EVENT_END && b.trigger(this.name, a)
        }
    }, d.gestures.Swipe = {
        name: "swipe",
        index: 40,
        defaults: {swipe_min_touches: 1, swipe_max_touches: 1, swipe_velocity: .7},
        handler: function (a, b) {
            if (a.eventType == d.EVENT_END) {
                if (b.options.swipe_max_touches > 0 && a.touches.length < b.options.swipe_min_touches && a.touches.length > b.options.swipe_max_touches)return;
                (a.velocityX > b.options.swipe_velocity || a.velocityY > b.options.swipe_velocity) && (b.trigger(this.name, a), b.trigger(this.name + a.direction, a))
            }
        }
    }, d.gestures.Tap = {
        name: "tap",
        index: 100,
        defaults: {
            tap_max_touchtime: 250,
            tap_max_distance: 10,
            tap_always: !0,
            doubletap_distance: 20,
            doubletap_interval: 300
        },
        handler: function (a, b) {
            if (a.eventType == d.EVENT_END && "touchcancel" != a.srcEvent.type) {
                var c = d.detection.previous, e = !1;
                if (a.deltaTime > b.options.tap_max_touchtime || a.distance > b.options.tap_max_distance)return;
                c && "tap" == c.name && a.timeStamp - c.lastEvent.timeStamp < b.options.doubletap_interval && a.distance < b.options.doubletap_distance && (b.trigger("doubletap", a), e = !0), (!e || b.options.tap_always) && (d.detection.current.name = "tap", b.trigger(d.detection.current.name, a))
            }
        }
    }, d.gestures.Touch = {
        name: "touch",
        index: -1 / 0,
        defaults: {prevent_default: !1, prevent_mouseevents: !1},
        handler: function (a, b) {
            return b.options.prevent_mouseevents && a.pointerType == d.POINTER_MOUSE ? void a.stopDetect() : (b.options.prevent_default && a.preventDefault(), void(a.eventType == d.EVENT_START && b.trigger(this.name, a)))
        }
    }, d.gestures.Transform = {
        name: "transform",
        index: 45,
        defaults: {transform_min_scale: .01, transform_min_rotation: 1, transform_always_block: !1},
        triggered: !1,
        handler: function (a, b) {
            if (d.detection.current.name != this.name && this.triggered)return b.trigger(this.name + "end", a), void(this.triggered = !1);
            if (!(a.touches.length < 2))switch (b.options.transform_always_block && a.preventDefault(), a.eventType) {
                case d.EVENT_START:
                    this.triggered = !1;
                    break;
                case d.EVENT_MOVE:
                    var c = Math.abs(1 - a.scale), e = Math.abs(a.rotation);
                    if (c < b.options.transform_min_scale && e < b.options.transform_min_rotation)return;
                    d.detection.current.name = this.name, this.triggered || (b.trigger(this.name + "start", a), this.triggered = !0), b.trigger(this.name, a), e > b.options.transform_min_rotation && b.trigger("rotate", a), c > b.options.transform_min_scale && (b.trigger("pinch", a), b.trigger("pinch" + (a.scale < 1 ? "in" : "out"), a));
                    break;
                case d.EVENT_END:
                    this.triggered && b.trigger(this.name + "end", a), this.triggered = !1
            }
        }
    }, "function" == typeof define && define.amd ? define(function () {
        return d
    }) : "object" == typeof module && module.exports ? module.exports = d : a.Hammer = d
}(window), function (a, b) {
    "use strict";
    function c(a, c) {
        a.event.bindDom = function (a, d, e) {
            c(a).on(d, function (a) {
                var c = a.originalEvent || a;
                c.pageX === b && (c.pageX = a.pageX, c.pageY = a.pageY), c.target || (c.target = a.target), c.which === b && (c.which = c.button), c.preventDefault || (c.preventDefault = a.preventDefault), c.stopPropagation || (c.stopPropagation = a.stopPropagation), e.call(this, c)
            })
        }, a.Instance.prototype.on = function (a, b) {
            return c(this.element).on(a, b)
        }, a.Instance.prototype.off = function (a, b) {
            return c(this.element).off(a, b)
        }, a.Instance.prototype.trigger = function (a, b) {
            var d = c(this.element);
            return d.has(b.target).length && (d = c(b.target)), d.trigger({type: a, gesture: b})
        }, c.fn.hammer = function (b) {
            return this.each(function () {
                var d = c(this), e = d.data("hammer");
                e ? "reset" == b ? a.detection.current = null : e && b && a.utils.extend(e.options, b) : d.data("hammer", new a(this, b || {}))
            })
        }
    }

    "function" == typeof define && "object" == typeof define.amd && define.amd ? define(["hammerjs", "jquery"], c) : c(a.Hammer, a.jQuery || a.Zepto)
}(this), function (a) {
    function b(a) {
        if (a in l.style)return a;
        var b = ["Moz", "Webkit", "O", "ms"], c = a.charAt(0).toUpperCase() + a.substr(1);
        if (a in l.style)return a;
        for (var d = 0; d < b.length; ++d) {
            var e = b[d] + c;
            if (e in l.style)return e
        }
    }

    function c() {
        return l.style[m.transform] = "", l.style[m.transform] = "rotateY(90deg)", "" !== l.style[m.transform]
    }

    function d(a) {
        return "string" == typeof a && this.parse(a), this
    }

    function e(a, b, c) {
        b === !0 ? a.queue(c) : b ? a.queue(b, c) : c()
    }

    function f(b) {
        var c = [];
        return a.each(b, function (b) {
            b = a.camelCase(b), b = a.transit.propertyMap[b] || a.cssProps[b] || b, b = i(b), -1 === a.inArray(b, c) && c.push(b)
        }), c
    }

    function g(b, c, d, e) {
        var g = f(b);
        a.cssEase[d] && (d = a.cssEase[d]);
        var h = "" + k(c) + " " + d;
        parseInt(e, 10) > 0 && (h += " " + k(e));
        var i = [];
        return a.each(g, function (a, b) {
            i.push(b + " " + h)
        }), i.join(", ")
    }

    function h(b, c) {
        c || (a.cssNumber[b] = !0), a.transit.propertyMap[b] = m.transform, a.cssHooks[b] = {
            get: function (c) {
                var d = a(c).css("transit:transform");
                return d.get(b)
            }, set: function (c, d) {
                var e = a(c).css("transit:transform");
                e.setFromString(b, d), a(c).css({"transit:transform": e})
            }
        }
    }

    function i(a) {
        return a.replace(/([A-Z])/g, function (a) {
            return "-" + a.toLowerCase()
        })
    }

    function j(a, b) {
        return "string" != typeof a || a.match(/^[\-0-9\.]+$/) ? "" + a + b : a
    }

    function k(b) {
        var c = b;
        return a.fx.speeds[c] && (c = a.fx.speeds[c]), j(c, "ms")
    }

    a.transit = {
        version: "0.9.9",
        propertyMap: {
            marginLeft: "margin",
            marginRight: "margin",
            marginBottom: "margin",
            marginTop: "margin",
            paddingLeft: "padding",
            paddingRight: "padding",
            paddingBottom: "padding",
            paddingTop: "padding"
        },
        enabled: !0,
        useTransitionEnd: !1
    };
    var l = document.createElement("div"), m = {}, n = navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
    m.transition = b("transition"), m.transitionDelay = b("transitionDelay"), m.transform = b("transform"), m.transformOrigin = b("transformOrigin"), m.transform3d = c();
    var o = {
        transition: "transitionEnd",
        MozTransition: "transitionend",
        OTransition: "oTransitionEnd",
        WebkitTransition: "webkitTransitionEnd",
        msTransition: "MSTransitionEnd"
    }, p = m.transitionEnd = o[m.transition] || null;
    for (var q in m)m.hasOwnProperty(q) && "undefined" == typeof a.support[q] && (a.support[q] = m[q]);
    l = null, a.cssEase = {
        _default: "ease",
        "in": "ease-in",
        out: "ease-out",
        "in-out": "ease-in-out",
        snap: "cubic-bezier(0,1,.5,1)",
        easeOutCubic: "cubic-bezier(.215,.61,.355,1)",
        easeInOutCubic: "cubic-bezier(.645,.045,.355,1)",
        easeInCirc: "cubic-bezier(.6,.04,.98,.335)",
        easeOutCirc: "cubic-bezier(.075,.82,.165,1)",
        easeInOutCirc: "cubic-bezier(.785,.135,.15,.86)",
        easeInExpo: "cubic-bezier(.95,.05,.795,.035)",
        easeOutExpo: "cubic-bezier(.19,1,.22,1)",
        easeInOutExpo: "cubic-bezier(1,0,0,1)",
        easeInQuad: "cubic-bezier(.55,.085,.68,.53)",
        easeOutQuad: "cubic-bezier(.25,.46,.45,.94)",
        easeInOutQuad: "cubic-bezier(.455,.03,.515,.955)",
        easeInQuart: "cubic-bezier(.895,.03,.685,.22)",
        easeOutQuart: "cubic-bezier(.165,.84,.44,1)",
        easeInOutQuart: "cubic-bezier(.77,0,.175,1)",
        easeInQuint: "cubic-bezier(.755,.05,.855,.06)",
        easeOutQuint: "cubic-bezier(.23,1,.32,1)",
        easeInOutQuint: "cubic-bezier(.86,0,.07,1)",
        easeInSine: "cubic-bezier(.47,0,.745,.715)",
        easeOutSine: "cubic-bezier(.39,.575,.565,1)",
        easeInOutSine: "cubic-bezier(.445,.05,.55,.95)",
        easeInBack: "cubic-bezier(.6,-.28,.735,.045)",
        easeOutBack: "cubic-bezier(.175, .885,.32,1.275)",
        easeInOutBack: "cubic-bezier(.68,-.55,.265,1.55)",
        epubOut: "cubic-bezier(.3,1,.0,1)"
    }, a.cssHooks["transit:transform"] = {
        get: function (b) {
            return a(b).data("transform") || new d
        }, set: function (b, c) {
            var e = c;
            e instanceof d || (e = new d(e)), b.style[m.transform] = "WebkitTransform" !== m.transform || n ? e.toString() : e.toString(!0), a(b).data("transform", e)
        }
    }, a.cssHooks.transform = {set: a.cssHooks["transit:transform"].set}, a.fn.jquery < "1.8" && (a.cssHooks.transformOrigin = {
        get: function (a) {
            return a.style[m.transformOrigin]
        }, set: function (a, b) {
            a.style[m.transformOrigin] = b
        }
    }, a.cssHooks.transition = {
        get: function (a) {
            return a.style[m.transition]
        }, set: function (a, b) {
            a.style[m.transition] = b
        }
    }), h("scale"), h("translate"), h("translateZ"), h("rotate"), h("rotateX"), h("rotateY"), h("rotate3d"), h("perspective"), h("skewX"), h("skewY"), h("x", !0), h("y", !0), d.prototype = {
        setFromString: function (a, b) {
            var c = "string" == typeof b ? b.split(",") : b.constructor === Array ? b : [b];
            c.unshift(a), d.prototype.set.apply(this, c)
        }, set: function (a) {
            var b = Array.prototype.slice.apply(arguments, [1]);
            this.setter[a] ? this.setter[a].apply(this, b) : this[a] = b.join(",")
        }, get: function (a) {
            return this.getter[a] ? this.getter[a].apply(this) : this[a] || 0
        }, setter: {
            rotate: function (a) {
                this.rotate = j(a, "deg")
            }, rotateX: function (a) {
                this.rotateX = j(a, "deg")
            }, rotateY: function (a) {
                this.rotateY = j(a, "deg")
            }, scale: function (a, b) {
                void 0 === b && (b = a), this.scale = a + "," + b
            }, skewX: function (a) {
                this.skewX = j(a, "deg")
            }, skewY: function (a) {
                this.skewY = j(a, "deg")
            }, perspective: function (a) {
                this.perspective = j(a, "px")
            }, x: function (a) {
                this.set("translate", a, null)
            }, y: function (a) {
                this.set("translate", null, a)
            }, translate: function (a, b) {
                void 0 === this._translateX && (this._translateX = 0), void 0 === this._translateY && (this._translateY = 0), null !== a && void 0 !== a && (this._translateX = j(a, "px")), null !== b && void 0 !== b && (this._translateY = j(b, "px")), this.translate = this._translateX + "," + this._translateY
            }, translateZ: function (a) {
                this.translateZ = j(a, "px")
            }
        }, getter: {
            x: function () {
                return this._translateX || 0
            }, y: function () {
                return this._translateY || 0
            }, translateZ: function () {
                return this.translateZ || 0
            }, scale: function () {
                var a = (this.scale || "1,1").split(",");
                return a[0] && (a[0] = parseFloat(a[0])), a[1] && (a[1] = parseFloat(a[1])), a[0] === a[1] ? a[0] : a
            }, rotate3d: function () {
                for (var a = (this.rotate3d || "0,0,0,0deg").split(","), b = 0; 3 >= b; ++b)a[b] && (a[b] = parseFloat(a[b]));
                return a[3] && (a[3] = j(a[3], "deg")), a
            }
        }, parse: function (a) {
            var b = this;
            a.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function (a, c, d) {
                b.setFromString(c, d)
            })
        }, toString: function (a) {
            var b = [];
            for (var c in this)if (this.hasOwnProperty(c)) {
                if (!m.transform3d && ("rotateX" === c || "rotateY" === c || "translateZ" === c || "perspective" === c || "transformOrigin" === c))continue;
                "_" !== c[0] && b.push(a && "scale" === c ? c + "3d(" + this[c] + ",1)" : a && "translate" === c ? c + "3d(" + this[c] + ",0)" : c + "(" + this[c] + ")")
            }
            return b.join(" ")
        }
    }, a.fn.transition = a.fn.transit = function (b, c, d, f) {
        var h = this, i = 0, j = !0;
        "function" == typeof c && (f = c, c = void 0), "function" == typeof d && (f = d, d = void 0), "undefined" != typeof b.easing && (d = b.easing, delete b.easing), "undefined" != typeof b.duration && (c = b.duration, delete b.duration), "undefined" != typeof b.complete && (f = b.complete, delete b.complete), "undefined" != typeof b.queue && (j = b.queue, delete b.queue), "undefined" != typeof b.delay && (i = b.delay, delete b.delay), "undefined" == typeof c && (c = a.fx.speeds._default), "undefined" == typeof d && (d = a.cssEase._default), a.fx.off && (c = 0), c = k(c);
        var l = g(b, c, d, i), n = a.transit.enabled && m.transition, o = n ? parseInt(c, 10) + parseInt(i, 10) : 0;
        if (0 === o) {
            var q = function (a) {
                h.css(b), f && f.apply(h), a && a()
            };
            return e(h, j, q), h
        }
        var r = {}, s = function (c) {
            var d = !1, e = function () {
                d && h.unbind(p, e), o > 0 && h.each(function () {
                    this.style[m.transition] = r[this] || null
                }), "function" == typeof f && f.apply(h), "function" == typeof c && c()
            };
            o > 0 && p && a.transit.useTransitionEnd ? (d = !0, h.bind(p, e)) : window.setTimeout(e, o), h.each(function () {
                o > 0 && (this.style[m.transition] = l), a(this).css(b)
            })
        }, t = function (a) {
            this.offsetWidth, s(a)
        };
        return e(h, j, t), this
    }, a.transit.getTransitionValue = g
}(jQuery), function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? module.exports = a : a(jQuery)
}(function (a) {
    function b(b) {
        var g = b || window.event, h = i.call(arguments, 1), j = 0, l = 0, m = 0, n = 0, o = 0, p = 0;
        if (b = a.event.fix(g), b.type = "mousewheel", "detail" in g && (m = -1 * g.detail), "wheelDelta" in g && (m = g.wheelDelta), "wheelDeltaY" in g && (m = g.wheelDeltaY), "wheelDeltaX" in g && (l = -1 * g.wheelDeltaX), "axis" in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY" in g && (m = -1 * g.deltaY, j = m), "deltaX" in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
            if (1 === g.deltaMode) {
                var q = a.data(this, "mousewheel-line-height");
                j *= q, m *= q, l *= q
            } else if (2 === g.deltaMode) {
                var r = a.data(this, "mousewheel-page-height");
                j *= r, m *= r, l *= r
            }
            if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
                var s = this.getBoundingClientRect();
                o = b.clientX - s.left, p = b.clientY - s.top
            }
            return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
        }
    }

    function c() {
        f = null
    }

    function d(a, b) {
        return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 === 0
    }

    var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"], h = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"], i = Array.prototype.slice;
    if (a.event.fixHooks)for (var j = g.length; j;)a.event.fixHooks[g[--j]] = a.event.mouseHooks;
    var k = a.event.special.mousewheel = {
        version: "3.1.12", setup: function () {
            if (this.addEventListener)for (var c = h.length; c;)this.addEventListener(h[--c], b, !1); else this.onmousewheel = b;
            a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this))
        }, teardown: function () {
            if (this.removeEventListener)for (var c = h.length; c;)this.removeEventListener(h[--c], b, !1); else this.onmousewheel = null;
            a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height")
        }, getLineHeight: function (b) {
            var c = a(b), d = c["offsetParent" in a.fn ? "offsetParent" : "parent"]();
            return d.length || (d = a("body")), parseInt(d.css("fontSize"), 10) || parseInt(c.css("fontSize"), 10) || 16
        }, getPageHeight: function (b) {
            return a(b).height()
        }, settings: {adjustOldDeltas: !0, normalizeOffset: !0}
    };
    a.fn.extend({
        mousewheel: function (a) {
            return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
        }, unmousewheel: function (a) {
            return this.unbind("mousewheel", a)
        }
    })
});
var _gsScope = "undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window;
(_gsScope._gsQueue || (_gsScope._gsQueue = [])).push(function () {
    "use strict";
    _gsScope._gsDefine("TweenMax", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (a, b, c) {
        var d = function (a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++]));
            return c
        }, e = function (a, b, d) {
            c.call(this, a, b, d), this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._dirty = !0, this.render = e.prototype.render
        }, f = 1e-10, g = c._internals, h = g.isSelector, i = g.isArray, j = e.prototype = c.to({}, .1, {}), k = [];
        e.version = "1.13.2", j.constructor = e, j.kill()._gc = !1, e.killTweensOf = e.killDelayedCallsTo = c.killTweensOf, e.getTweensOf = c.getTweensOf, e.lagSmoothing = c.lagSmoothing, e.ticker = c.ticker, e.render = c.render, j.invalidate = function () {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), c.prototype.invalidate.call(this)
        }, j.updateTo = function (a, b) {
            var d, e = this.ratio;
            b && this._startTime < this._timeline._time && (this._startTime = this._timeline._time, this._uncache(!1), this._gc ? this._enabled(!0, !1) : this._timeline.insert(this, this._startTime - this._delay));
            for (d in a)this.vars[d] = a[d];
            if (this._initted)if (b)this._initted = !1; else if (this._gc && this._enabled(!0, !1), this._notifyPluginsOfEnabled && this._firstPT && c._onPluginEvent("_onDisable", this), this._time / this._duration > .998) {
                var f = this._time;
                this.render(0, !0, !1), this._initted = !1, this.render(f, !0, !1)
            } else if (this._time > 0) {
                this._initted = !1, this._init();
                for (var g, h = 1 / (1 - e), i = this._firstPT; i;)g = i.s + i.c, i.c *= h, i.s = g - i.c, i = i._next
            }
            return this
        }, j.render = function (a, b, c) {
            this._initted || 0 === this._duration && this.vars.repeat && this.invalidate();
            var d, e, h, i, j, l, m, n, o = this._dirty ? this.totalDuration() : this._totalDuration, p = this._time, q = this._totalTime, r = this._cycle, s = this._duration, t = this._rawPrevTime;
            if (a >= o ? (this._totalTime = o, this._cycle = this._repeat, this._yoyo && 0 !== (1 & this._cycle) ? (this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0) : (this._time = s, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1), this._reversed || (d = !0, e = "onComplete"), 0 === s && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), (0 === a || 0 > t || t === f) && t !== a && (c = !0, t > f && (e = "onReverseComplete")), this._rawPrevTime = n = !b || a || t === a ? a : f)) : 1e-7 > a ? (this._totalTime = this._time = this._cycle = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== q || 0 === s && t > 0 && t !== f) && (e = "onReverseComplete", d = this._reversed), 0 > a && (this._active = !1, 0 === s && (this._initted || !this.vars.lazy || c) && (t >= 0 && (c = !0), this._rawPrevTime = n = !b || a || t === a ? a : f)), this._initted || (c = !0)) : (this._totalTime = this._time = a, 0 !== this._repeat && (i = s + this._repeatDelay, this._cycle = this._totalTime / i >> 0, 0 !== this._cycle && this._cycle === this._totalTime / i && this._cycle--, this._time = this._totalTime - this._cycle * i, this._yoyo && 0 !== (1 & this._cycle) && (this._time = s - this._time), this._time > s ? this._time = s : this._time < 0 && (this._time = 0)), this._easeType ? (j = this._time / s, l = this._easeType, m = this._easePower, (1 === l || 3 === l && j >= .5) && (j = 1 - j), 3 === l && (j *= 2), 1 === m ? j *= j : 2 === m ? j *= j * j : 3 === m ? j *= j * j * j : 4 === m && (j *= j * j * j * j), this.ratio = 1 === l ? 1 - j : 2 === l ? j : this._time / s < .5 ? j / 2 : 1 - j / 2) : this.ratio = this._ease.getRatio(this._time / s)), p === this._time && !c && r === this._cycle)return void(q !== this._totalTime && this._onUpdate && (b || this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || k)));
            if (!this._initted) {
                if (this._init(), !this._initted || this._gc)return;
                if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration))return this._time = p, this._totalTime = q, this._rawPrevTime = t, this._cycle = r, g.lazyTweens.push(this), void(this._lazy = [a, b]);
                this._time && !d ? this.ratio = this._ease.getRatio(this._time / s) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
            }
            for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== p && a >= 0 && (this._active = !0), 0 === q && (2 === this._initted && a > 0 && this._init(), this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), this.vars.onStart && (0 !== this._totalTime || 0 === s) && (b || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || k))), h = this._firstPT; h;)h.f ? h.t[h.p](h.c * this.ratio + h.s) : h.t[h.p] = h.c * this.ratio + h.s, h = h._next;
            this._onUpdate && (0 > a && this._startAt && this._startTime && this._startAt.render(a, b, c), b || (this._totalTime !== q || d) && this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || k)), this._cycle !== r && (b || this._gc || this.vars.onRepeat && this.vars.onRepeat.apply(this.vars.onRepeatScope || this, this.vars.onRepeatParams || k)), e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(a, b, c), d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[e] && this.vars[e].apply(this.vars[e + "Scope"] || this, this.vars[e + "Params"] || k), 0 === s && this._rawPrevTime === f && n !== f && (this._rawPrevTime = 0))
        }, e.to = function (a, b, c) {
            return new e(a, b, c)
        }, e.from = function (a, b, c) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new e(a, b, c)
        }, e.fromTo = function (a, b, c, d) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, new e(a, b, d)
        }, e.staggerTo = e.allTo = function (a, b, f, g, j, l, m) {
            g = g || 0;
            var n, o, p, q, r = f.delay || 0, s = [], t = function () {
                f.onComplete && f.onComplete.apply(f.onCompleteScope || this, arguments), j.apply(m || this, l || k)
            };
            for (i(a) || ("string" == typeof a && (a = c.selector(a) || a), h(a) && (a = d(a))), n = a.length, p = 0; n > p; p++) {
                o = {};
                for (q in f)o[q] = f[q];
                o.delay = r, p === n - 1 && j && (o.onComplete = t), s[p] = new e(a[p], b, o), r += g
            }
            return s
        }, e.staggerFrom = e.allFrom = function (a, b, c, d, f, g, h) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, e.staggerTo(a, b, c, d, f, g, h)
        }, e.staggerFromTo = e.allFromTo = function (a, b, c, d, f, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, e.staggerTo(a, b, d, f, g, h, i)
        }, e.delayedCall = function (a, b, c, d, f) {
            return new e(b, 0, {
                delay: a,
                onComplete: b,
                onCompleteParams: c,
                onCompleteScope: d,
                onReverseComplete: b,
                onReverseCompleteParams: c,
                onReverseCompleteScope: d,
                immediateRender: !1,
                useFrames: f,
                overwrite: 0
            })
        }, e.set = function (a, b) {
            return new e(a, 0, b)
        }, e.isTweening = function (a) {
            return c.getTweensOf(a, !0).length > 0
        };
        var l = function (a, b) {
            for (var d = [], e = 0, f = a._first; f;)f instanceof c ? d[e++] = f : (b && (d[e++] = f), d = d.concat(l(f, b)), e = d.length), f = f._next;
            return d
        }, m = e.getAllTweens = function (b) {
            return l(a._rootTimeline, b).concat(l(a._rootFramesTimeline, b))
        };
        e.killAll = function (a, c, d, e) {
            null == c && (c = !0), null == d && (d = !0);
            var f, g, h, i = m(0 != e), j = i.length, k = c && d && e;
            for (h = 0; j > h; h++)g = i[h], (k || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && (a ? g.totalTime(g._reversed ? 0 : g.totalDuration()) : g._enabled(!1, !1))
        }, e.killChildTweensOf = function (a, b) {
            if (null != a) {
                var f, j, k, l, m, n = g.tweenLookup;
                if ("string" == typeof a && (a = c.selector(a) || a), h(a) && (a = d(a)), i(a))for (l = a.length; --l > -1;)e.killChildTweensOf(a[l], b); else {
                    f = [];
                    for (k in n)for (j = n[k].target.parentNode; j;)j === a && (f = f.concat(n[k].tweens)), j = j.parentNode;
                    for (m = f.length, l = 0; m > l; l++)b && f[l].totalTime(f[l].totalDuration()), f[l]._enabled(!1, !1)
                }
            }
        };
        var n = function (a, c, d, e) {
            c = c !== !1, d = d !== !1, e = e !== !1;
            for (var f, g, h = m(e), i = c && d && e, j = h.length; --j > -1;)g = h[j], (i || g instanceof b || (f = g.target === g.vars.onComplete) && d || c && !f) && g.paused(a)
        };
        return e.pauseAll = function (a, b, c) {
            n(!0, a, b, c)
        }, e.resumeAll = function (a, b, c) {
            n(!1, a, b, c)
        }, e.globalTimeScale = function (b) {
            var d = a._rootTimeline, e = c.ticker.time;
            return arguments.length ? (b = b || f, d._startTime = e - (e - d._startTime) * d._timeScale / b, d = a._rootFramesTimeline, e = c.ticker.frame, d._startTime = e - (e - d._startTime) * d._timeScale / b, d._timeScale = a._rootTimeline._timeScale = b, b) : d._timeScale
        }, j.progress = function (a) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), !1) : this._time / this.duration()
        }, j.totalProgress = function (a) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, !1) : this._totalTime / this.totalDuration()
        }, j.time = function (a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(a, b)) : this._time
        }, j.duration = function (b) {
            return arguments.length ? a.prototype.duration.call(this, b) : this._duration
        }, j.totalDuration = function (a) {
            return arguments.length ? -1 === this._repeat ? this : this.duration((a - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat, this._dirty = !1), this._totalDuration)
        }, j.repeat = function (a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat
        }, j.repeatDelay = function (a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay
        }, j.yoyo = function (a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo
        }, e
    }, !0), _gsScope._gsDefine("TimelineLite", ["core.Animation", "core.SimpleTimeline", "TweenLite"], function (a, b, c) {
        var d = function (a) {
            b.call(this, a), this._labels = {}, this.autoRemoveChildren = this.vars.autoRemoveChildren === !0, this.smoothChildTiming = this.vars.smoothChildTiming === !0, this._sortChildren = !0, this._onUpdate = this.vars.onUpdate;
            var c, d, e = this.vars;
            for (d in e)c = e[d], h(c) && -1 !== c.join("").indexOf("{self}") && (e[d] = this._swapSelfInParams(c));
            h(e.tweens) && this.add(e.tweens, 0, e.align, e.stagger)
        }, e = 1e-10, f = c._internals, g = f.isSelector, h = f.isArray, i = f.lazyTweens, j = f.lazyRender, k = [], l = _gsScope._gsDefine.globals, m = function (a) {
            var b, c = {};
            for (b in a)c[b] = a[b];
            return c
        }, n = function (a, b, c, d) {
            var e = a._timeline._totalTime;
            (b || !this._forcingPlayhead) && (a._timeline.pause(a._startTime), b && b.apply(d || a._timeline, c || k), this._forcingPlayhead && a._timeline.seek(e))
        }, o = function (a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++]));
            return c
        }, p = d.prototype = new b;
        return d.version = "1.13.2", p.constructor = d, p.kill()._gc = p._forcingPlayhead = !1, p.to = function (a, b, d, e) {
            var f = d.repeat && l.TweenMax || c;
            return b ? this.add(new f(a, b, d), e) : this.set(a, d, e)
        }, p.from = function (a, b, d, e) {
            return this.add((d.repeat && l.TweenMax || c).from(a, b, d), e)
        }, p.fromTo = function (a, b, d, e, f) {
            var g = e.repeat && l.TweenMax || c;
            return b ? this.add(g.fromTo(a, b, d, e), f) : this.set(a, e, f)
        }, p.staggerTo = function (a, b, e, f, h, i, j, k) {
            var l, n = new d({
                onComplete: i,
                onCompleteParams: j,
                onCompleteScope: k,
                smoothChildTiming: this.smoothChildTiming
            });
            for ("string" == typeof a && (a = c.selector(a) || a), g(a) && (a = o(a)), f = f || 0, l = 0; l < a.length; l++)e.startAt && (e.startAt = m(e.startAt)), n.to(a[l], b, m(e), l * f);
            return this.add(n, h)
        }, p.staggerFrom = function (a, b, c, d, e, f, g, h) {
            return c.immediateRender = 0 != c.immediateRender, c.runBackwards = !0, this.staggerTo(a, b, c, d, e, f, g, h)
        }, p.staggerFromTo = function (a, b, c, d, e, f, g, h, i) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, this.staggerTo(a, b, d, e, f, g, h, i)
        }, p.call = function (a, b, d, e) {
            return this.add(c.delayedCall(0, a, b, d), e)
        }, p.set = function (a, b, d) {
            return d = this._parseTimeOrLabel(d, 0, !0), null == b.immediateRender && (b.immediateRender = d === this._time && !this._paused), this.add(new c(a, 0, b), d)
        }, d.exportRoot = function (a, b) {
            a = a || {}, null == a.smoothChildTiming && (a.smoothChildTiming = !0);
            var e, f, g = new d(a), h = g._timeline;
            for (null == b && (b = !0), h._remove(g, !0), g._startTime = 0, g._rawPrevTime = g._time = g._totalTime = h._time, e = h._first; e;)f = e._next, b && e instanceof c && e.target === e.vars.onComplete || g.add(e, e._startTime - e._delay), e = f;
            return h.add(g, 0), g
        }, p.add = function (e, f, g, i) {
            var j, k, l, m, n, o;
            if ("number" != typeof f && (f = this._parseTimeOrLabel(f, 0, !0, e)), !(e instanceof a)) {
                if (e instanceof Array || e && e.push && h(e)) {
                    for (g = g || "normal", i = i || 0, j = f, k = e.length, l = 0; k > l; l++)h(m = e[l]) && (m = new d({tweens: m})), this.add(m, j), "string" != typeof m && "function" != typeof m && ("sequence" === g ? j = m._startTime + m.totalDuration() / m._timeScale : "start" === g && (m._startTime -= m.delay())), j += i;
                    return this._uncache(!0)
                }
                if ("string" == typeof e)return this.addLabel(e, f);
                if ("function" != typeof e)throw"Cannot add " + e + " into the timeline; it is not a tween, timeline, function, or string.";
                e = c.delayedCall(0, e)
            }
            if (b.prototype.add.call(this, e, f), (this._gc || this._time === this._duration) && !this._paused && this._duration < this.duration())for (n = this, o = n.rawTime() > e._startTime; n._timeline;)o && n._timeline.smoothChildTiming ? n.totalTime(n._totalTime, !0) : n._gc && n._enabled(!0, !1), n = n._timeline;
            return this
        }, p.remove = function (b) {
            if (b instanceof a)return this._remove(b, !1);
            if (b instanceof Array || b && b.push && h(b)) {
                for (var c = b.length; --c > -1;)this.remove(b[c]);
                return this
            }
            return "string" == typeof b ? this.removeLabel(b) : this.kill(null, b)
        }, p._remove = function (a, c) {
            b.prototype._remove.call(this, a, c);
            var d = this._last;
            return d ? this._time > d._startTime + d._totalDuration / d._timeScale && (this._time = this.duration(), this._totalTime = this._totalDuration) : this._time = this._totalTime = this._duration = this._totalDuration = 0, this
        }, p.append = function (a, b) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a))
        }, p.insert = p.insertMultiple = function (a, b, c, d) {
            return this.add(a, b || 0, c, d)
        }, p.appendMultiple = function (a, b, c, d) {
            return this.add(a, this._parseTimeOrLabel(null, b, !0, a), c, d)
        }, p.addLabel = function (a, b) {
            return this._labels[a] = this._parseTimeOrLabel(b), this
        }, p.addPause = function (a, b, c, d) {
            return this.call(n, ["{self}", b, c, d], this, a)
        }, p.removeLabel = function (a) {
            return delete this._labels[a], this
        }, p.getLabelTime = function (a) {
            return null != this._labels[a] ? this._labels[a] : -1
        }, p._parseTimeOrLabel = function (b, c, d, e) {
            var f;
            if (e instanceof a && e.timeline === this)this.remove(e); else if (e && (e instanceof Array || e.push && h(e)))for (f = e.length; --f > -1;)e[f] instanceof a && e[f].timeline === this && this.remove(e[f]);
            if ("string" == typeof c)return this._parseTimeOrLabel(c, d && "number" == typeof b && null == this._labels[c] ? b - this.duration() : 0, d);
            if (c = c || 0, "string" != typeof b || !isNaN(b) && null == this._labels[b])null == b && (b = this.duration()); else {
                if (f = b.indexOf("="), -1 === f)return null == this._labels[b] ? d ? this._labels[b] = this.duration() + c : c : this._labels[b] + c;
                c = parseInt(b.charAt(f - 1) + "1", 10) * Number(b.substr(f + 1)), b = f > 1 ? this._parseTimeOrLabel(b.substr(0, f - 1), 0, d) : this.duration()
            }
            return Number(b) + c
        }, p.seek = function (a, b) {
            return this.totalTime("number" == typeof a ? a : this._parseTimeOrLabel(a), b !== !1)
        }, p.stop = function () {
            return this.paused(!0)
        }, p.gotoAndPlay = function (a, b) {
            return this.play(a, b)
        }, p.gotoAndStop = function (a, b) {
            return this.pause(a, b)
        }, p.render = function (a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, f, g, h, l, m = this._dirty ? this.totalDuration() : this._totalDuration, n = this._time, o = this._startTime, p = this._timeScale, q = this._paused;
            if (a >= m ? (this._totalTime = this._time = m, this._reversed || this._hasPausedChild() || (f = !0, h = "onComplete", 0 === this._duration && (0 === a || this._rawPrevTime < 0 || this._rawPrevTime === e) && this._rawPrevTime !== a && this._first && (l = !0, this._rawPrevTime > e && (h = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, a = m + 1e-4) : 1e-7 > a ? (this._totalTime = this._time = 0, (0 !== n || 0 === this._duration && this._rawPrevTime !== e && (this._rawPrevTime > 0 || 0 > a && this._rawPrevTime >= 0)) && (h = "onReverseComplete", f = this._reversed), 0 > a ? (this._active = !1, this._rawPrevTime >= 0 && this._first && (l = !0), this._rawPrevTime = a) : (this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, a = 0, this._initted || (l = !0))) : this._totalTime = this._time = this._rawPrevTime = a, this._time !== n && this._first || c || l) {
                if (this._initted || (this._initted = !0), this._active || !this._paused && this._time !== n && a > 0 && (this._active = !0), 0 === n && this.vars.onStart && 0 !== this._time && (b || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || k)), this._time >= n)for (d = this._first; d && (g = d._next, !this._paused || q);)(d._active || d._startTime <= this._time && !d._paused && !d._gc) && (d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = g; else for (d = this._last; d && (g = d._prev, !this._paused || q);)(d._active || d._startTime <= n && !d._paused && !d._gc) && (d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = g;
                this._onUpdate && (b || (i.length && j(), this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || k))), h && (this._gc || (o === this._startTime || p !== this._timeScale) && (0 === this._time || m >= this.totalDuration()) && (f && (i.length && j(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[h] && this.vars[h].apply(this.vars[h + "Scope"] || this, this.vars[h + "Params"] || k)))
            }
        }, p._hasPausedChild = function () {
            for (var a = this._first; a;) {
                if (a._paused || a instanceof d && a._hasPausedChild())return !0;
                a = a._next
            }
            return !1
        }, p.getChildren = function (a, b, d, e) {
            e = e || -9999999999;
            for (var f = [], g = this._first, h = 0; g;)g._startTime < e || (g instanceof c ? b !== !1 && (f[h++] = g) : (d !== !1 && (f[h++] = g), a !== !1 && (f = f.concat(g.getChildren(!0, b, d)), h = f.length))), g = g._next;
            return f
        }, p.getTweensOf = function (a, b) {
            var d, e, f = this._gc, g = [], h = 0;
            for (f && this._enabled(!0, !0), d = c.getTweensOf(a), e = d.length; --e > -1;)(d[e].timeline === this || b && this._contains(d[e])) && (g[h++] = d[e]);
            return f && this._enabled(!1, !0), g
        }, p._contains = function (a) {
            for (var b = a.timeline; b;) {
                if (b === this)return !0;
                b = b.timeline
            }
            return !1
        }, p.shiftChildren = function (a, b, c) {
            c = c || 0;
            for (var d, e = this._first, f = this._labels; e;)e._startTime >= c && (e._startTime += a), e = e._next;
            if (b)for (d in f)f[d] >= c && (f[d] += a);
            return this._uncache(!0)
        }, p._kill = function (a, b) {
            if (!a && !b)return this._enabled(!1, !1);
            for (var c = b ? this.getTweensOf(b) : this.getChildren(!0, !0, !1), d = c.length, e = !1; --d > -1;)c[d]._kill(a, b) && (e = !0);
            return e
        }, p.clear = function (a) {
            var b = this.getChildren(!1, !0, !0), c = b.length;
            for (this._time = this._totalTime = 0; --c > -1;)b[c]._enabled(!1, !1);
            return a !== !1 && (this._labels = {}), this._uncache(!0)
        }, p.invalidate = function () {
            for (var b = this._first; b;)b.invalidate(), b = b._next;
            return a.prototype.invalidate.call(this)
        }, p._enabled = function (a, c) {
            if (a === this._gc)for (var d = this._first; d;)d._enabled(a, !0), d = d._next;
            return b.prototype._enabled.call(this, a, c)
        }, p.totalTime = function () {
            this._forcingPlayhead = !0;
            var b = a.prototype.totalTime.apply(this, arguments);
            return this._forcingPlayhead = !1, b
        }, p.duration = function (a) {
            return arguments.length ? (0 !== this.duration() && 0 !== a && this.timeScale(this._duration / a), this) : (this._dirty && this.totalDuration(), this._duration)
        }, p.totalDuration = function (a) {
            if (!arguments.length) {
                if (this._dirty) {
                    for (var b, c, d = 0, e = this._last, f = 999999999999; e;)b = e._prev, e._dirty && e.totalDuration(), e._startTime > f && this._sortChildren && !e._paused ? this.add(e, e._startTime - e._delay) : f = e._startTime, e._startTime < 0 && !e._paused && (d -= e._startTime, this._timeline.smoothChildTiming && (this._startTime += e._startTime / this._timeScale), this.shiftChildren(-e._startTime, !1, -9999999999), f = 0), c = e._startTime + e._totalDuration / e._timeScale, c > d && (d = c), e = b;
                    this._duration = this._totalDuration = d, this._dirty = !1
                }
                return this._totalDuration
            }
            return 0 !== this.totalDuration() && 0 !== a && this.timeScale(this._totalDuration / a), this
        }, p.usesFrames = function () {
            for (var b = this._timeline; b._timeline;)b = b._timeline;
            return b === a._rootFramesTimeline
        }, p.rawTime = function () {
            return this._paused ? this._totalTime : (this._timeline.rawTime() - this._startTime) * this._timeScale
        }, d
    }, !0), _gsScope._gsDefine("TimelineMax", ["TimelineLite", "TweenLite", "easing.Ease"], function (a, b, c) {
        var d = function (b) {
            a.call(this, b), this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._cycle = 0, this._yoyo = this.vars.yoyo === !0, this._dirty = !0
        }, e = 1e-10, f = [], g = b._internals, h = g.lazyTweens, i = g.lazyRender, j = new c(null, null, 1, 0), k = d.prototype = new a;
        return k.constructor = d, k.kill()._gc = !1, d.version = "1.13.2", k.invalidate = function () {
            return this._yoyo = this.vars.yoyo === !0, this._repeat = this.vars.repeat || 0, this._repeatDelay = this.vars.repeatDelay || 0, this._uncache(!0), a.prototype.invalidate.call(this)
        }, k.addCallback = function (a, c, d, e) {
            return this.add(b.delayedCall(0, a, d, e), c)
        }, k.removeCallback = function (a, b) {
            if (a)if (null == b)this._kill(null, a); else for (var c = this.getTweensOf(a, !1), d = c.length, e = this._parseTimeOrLabel(b); --d > -1;)c[d]._startTime === e && c[d]._enabled(!1, !1);
            return this
        }, k.tweenTo = function (a, c) {
            c = c || {};
            var d, e, g, h = {ease: j, overwrite: c.delay ? 2 : 1, useFrames: this.usesFrames(), immediateRender: !1};
            for (e in c)h[e] = c[e];
            return h.time = this._parseTimeOrLabel(a), d = Math.abs(Number(h.time) - this._time) / this._timeScale || .001, g = new b(this, d, h), h.onStart = function () {
                g.target.paused(!0), g.vars.time !== g.target.time() && d === g.duration() && g.duration(Math.abs(g.vars.time - g.target.time()) / g.target._timeScale), c.onStart && c.onStart.apply(c.onStartScope || g, c.onStartParams || f)
            }, g
        }, k.tweenFromTo = function (a, b, c) {
            c = c || {}, a = this._parseTimeOrLabel(a), c.startAt = {
                onComplete: this.seek,
                onCompleteParams: [a],
                onCompleteScope: this
            }, c.immediateRender = c.immediateRender !== !1;
            var d = this.tweenTo(b, c);
            return d.duration(Math.abs(d.vars.time - a) / this._timeScale || .001)
        }, k.render = function (a, b, c) {
            this._gc && this._enabled(!0, !1);
            var d, g, j, k, l, m, n = this._dirty ? this.totalDuration() : this._totalDuration, o = this._duration, p = this._time, q = this._totalTime, r = this._startTime, s = this._timeScale, t = this._rawPrevTime, u = this._paused, v = this._cycle;
            if (a >= n ? (this._locked || (this._totalTime = n, this._cycle = this._repeat), this._reversed || this._hasPausedChild() || (g = !0, k = "onComplete", 0 === this._duration && (0 === a || 0 > t || t === e) && t !== a && this._first && (l = !0, t > e && (k = "onReverseComplete"))), this._rawPrevTime = this._duration || !b || a || this._rawPrevTime === a ? a : e, this._yoyo && 0 !== (1 & this._cycle) ? this._time = a = 0 : (this._time = o, a = o + 1e-4)) : 1e-7 > a ? (this._locked || (this._totalTime = this._cycle = 0), this._time = 0, (0 !== p || 0 === o && t !== e && (t > 0 || 0 > a && t >= 0) && !this._locked) && (k = "onReverseComplete", g = this._reversed), 0 > a ? (this._active = !1, t >= 0 && this._first && (l = !0), this._rawPrevTime = a) : (this._rawPrevTime = o || !b || a || this._rawPrevTime === a ? a : e, a = 0, this._initted || (l = !0))) : (0 === o && 0 > t && (l = !0), this._time = this._rawPrevTime = a, this._locked || (this._totalTime = a, 0 !== this._repeat && (m = o + this._repeatDelay, this._cycle = this._totalTime / m >> 0, 0 !== this._cycle && this._cycle === this._totalTime / m && this._cycle--, this._time = this._totalTime - this._cycle * m, this._yoyo && 0 !== (1 & this._cycle) && (this._time = o - this._time), this._time > o ? (this._time = o, a = o + 1e-4) : this._time < 0 ? this._time = a = 0 : a = this._time))), this._cycle !== v && !this._locked) {
                var w = this._yoyo && 0 !== (1 & v), x = w === (this._yoyo && 0 !== (1 & this._cycle)), y = this._totalTime, z = this._cycle, A = this._rawPrevTime, B = this._time;
                if (this._totalTime = v * o, this._cycle < v ? w = !w : this._totalTime += o, this._time = p, this._rawPrevTime = 0 === o ? t - 1e-4 : t, this._cycle = v, this._locked = !0, p = w ? 0 : o, this.render(p, b, 0 === o), b || this._gc || this.vars.onRepeat && this.vars.onRepeat.apply(this.vars.onRepeatScope || this, this.vars.onRepeatParams || f), x && (p = w ? o + 1e-4 : -1e-4, this.render(p, !0, !1)), this._locked = !1, this._paused && !u)return;
                this._time = B, this._totalTime = y, this._cycle = z, this._rawPrevTime = A
            }
            if (!(this._time !== p && this._first || c || l))return void(q !== this._totalTime && this._onUpdate && (b || this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || f)));
            if (this._initted || (this._initted = !0), this._active || !this._paused && this._totalTime !== q && a > 0 && (this._active = !0), 0 === q && this.vars.onStart && 0 !== this._totalTime && (b || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || f)), this._time >= p)for (d = this._first; d && (j = d._next, !this._paused || u);)(d._active || d._startTime <= this._time && !d._paused && !d._gc) && (d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = j; else for (d = this._last; d && (j = d._prev, !this._paused || u);)(d._active || d._startTime <= p && !d._paused && !d._gc) && (d._reversed ? d.render((d._dirty ? d.totalDuration() : d._totalDuration) - (a - d._startTime) * d._timeScale, b, c) : d.render((a - d._startTime) * d._timeScale, b, c)), d = j;
            this._onUpdate && (b || (h.length && i(), this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || f))), k && (this._locked || this._gc || (r === this._startTime || s !== this._timeScale) && (0 === this._time || n >= this.totalDuration()) && (g && (h.length && i(), this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[k] && this.vars[k].apply(this.vars[k + "Scope"] || this, this.vars[k + "Params"] || f)))
        }, k.getActive = function (a, b, c) {
            null == a && (a = !0), null == b && (b = !0), null == c && (c = !1);
            var d, e, f = [], g = this.getChildren(a, b, c), h = 0, i = g.length;
            for (d = 0; i > d; d++)e = g[d], e.isActive() && (f[h++] = e);
            return f
        }, k.getLabelAfter = function (a) {
            a || 0 !== a && (a = this._time);
            var b, c = this.getLabelsArray(), d = c.length;
            for (b = 0; d > b; b++)if (c[b].time > a)return c[b].name;
            return null
        }, k.getLabelBefore = function (a) {
            null == a && (a = this._time);
            for (var b = this.getLabelsArray(), c = b.length; --c > -1;)if (b[c].time < a)return b[c].name;
            return null
        }, k.getLabelsArray = function () {
            var a, b = [], c = 0;
            for (a in this._labels)b[c++] = {time: this._labels[a], name: a};
            return b.sort(function (a, b) {
                return a.time - b.time
            }), b
        }, k.progress = function (a, b) {
            return arguments.length ? this.totalTime(this.duration() * (this._yoyo && 0 !== (1 & this._cycle) ? 1 - a : a) + this._cycle * (this._duration + this._repeatDelay), b) : this._time / this.duration()
        }, k.totalProgress = function (a, b) {
            return arguments.length ? this.totalTime(this.totalDuration() * a, b) : this._totalTime / this.totalDuration()
        }, k.totalDuration = function (b) {
            return arguments.length ? -1 === this._repeat ? this : this.duration((b - this._repeat * this._repeatDelay) / (this._repeat + 1)) : (this._dirty && (a.prototype.totalDuration.call(this), this._totalDuration = -1 === this._repeat ? 999999999999 : this._duration * (this._repeat + 1) + this._repeatDelay * this._repeat), this._totalDuration)
        }, k.time = function (a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), a > this._duration && (a = this._duration), this._yoyo && 0 !== (1 & this._cycle) ? a = this._duration - a + this._cycle * (this._duration + this._repeatDelay) : 0 !== this._repeat && (a += this._cycle * (this._duration + this._repeatDelay)), this.totalTime(a, b)) : this._time
        }, k.repeat = function (a) {
            return arguments.length ? (this._repeat = a, this._uncache(!0)) : this._repeat
        }, k.repeatDelay = function (a) {
            return arguments.length ? (this._repeatDelay = a, this._uncache(!0)) : this._repeatDelay
        }, k.yoyo = function (a) {
            return arguments.length ? (this._yoyo = a, this) : this._yoyo
        }, k.currentLabel = function (a) {
            return arguments.length ? this.seek(a, !0) : this.getLabelBefore(this._time + 1e-8)
        }, d
    }, !0), function () {
        var a = 180 / Math.PI, b = [], c = [], d = [], e = {}, f = function (a, b, c, d) {
            this.a = a, this.b = b, this.c = c, this.d = d, this.da = d - a, this.ca = c - a, this.ba = b - a
        }, g = ",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,", h = function (a, b, c, d) {
            var e = {a: a}, f = {}, g = {}, h = {c: d}, i = (a + b) / 2, j = (b + c) / 2, k = (c + d) / 2, l = (i + j) / 2, m = (j + k) / 2, n = (m - l) / 8;
            return e.b = i + (a - i) / 4, f.b = l + n, e.c = f.a = (e.b + f.b) / 2, f.c = g.a = (l + m) / 2, g.b = m - n, h.b = k + (d - k) / 4, g.c = h.a = (g.b + h.b) / 2, [e, f, g, h]
        }, i = function (a, e, f, g, i) {
            var j, k, l, m, n, o, p, q, r, s, t, u, v, w = a.length - 1, x = 0, y = a[0].a;
            for (j = 0; w > j; j++)n = a[x], k = n.a, l = n.d, m = a[x + 1].d, i ? (t = b[j], u = c[j], v = (u + t) * e * .25 / (g ? .5 : d[j] || .5), o = l - (l - k) * (g ? .5 * e : 0 !== t ? v / t : 0), p = l + (m - l) * (g ? .5 * e : 0 !== u ? v / u : 0), q = l - (o + ((p - o) * (3 * t / (t + u) + .5) / 4 || 0))) : (o = l - (l - k) * e * .5, p = l + (m - l) * e * .5, q = l - (o + p) / 2), o += q, p += q, n.c = r = o, n.b = 0 !== j ? y : y = n.a + .6 * (n.c - n.a), n.da = l - k, n.ca = r - k, n.ba = y - k, f ? (s = h(k, y, r, l), a.splice(x, 1, s[0], s[1], s[2], s[3]), x += 4) : x++, y = p;
            n = a[x], n.b = y, n.c = y + .4 * (n.d - y), n.da = n.d - n.a, n.ca = n.c - n.a, n.ba = y - n.a, f && (s = h(n.a, y, n.c, n.d), a.splice(x, 1, s[0], s[1], s[2], s[3]))
        }, j = function (a, d, e, g) {
            var h, i, j, k, l, m, n = [];
            if (g)for (a = [g].concat(a), i = a.length; --i > -1;)"string" == typeof(m = a[i][d]) && "=" === m.charAt(1) && (a[i][d] = g[d] + Number(m.charAt(0) + m.substr(2)));
            if (h = a.length - 2, 0 > h)return n[0] = new f(a[0][d], 0, 0, a[-1 > h ? 0 : 1][d]), n;
            for (i = 0; h > i; i++)j = a[i][d], k = a[i + 1][d], n[i] = new f(j, 0, 0, k), e && (l = a[i + 2][d], b[i] = (b[i] || 0) + (k - j) * (k - j), c[i] = (c[i] || 0) + (l - k) * (l - k));
            return n[i] = new f(a[i][d], 0, 0, a[i + 1][d]), n
        }, k = function (a, f, h, k, l, m) {
            var n, o, p, q, r, s, t, u, v = {}, w = [], x = m || a[0];
            l = "string" == typeof l ? "," + l + "," : g, null == f && (f = 1);
            for (o in a[0])w.push(o);
            if (a.length > 1) {
                for (u = a[a.length - 1], t = !0, n = w.length; --n > -1;)if (o = w[n], Math.abs(x[o] - u[o]) > .05) {
                    t = !1;
                    break
                }
                t && (a = a.concat(), m && a.unshift(m), a.push(a[1]), m = a[a.length - 3])
            }
            for (b.length = c.length = d.length = 0, n = w.length; --n > -1;)o = w[n], e[o] = -1 !== l.indexOf("," + o + ","), v[o] = j(a, o, e[o], m);
            for (n = b.length; --n > -1;)b[n] = Math.sqrt(b[n]), c[n] = Math.sqrt(c[n]);
            if (!k) {
                for (n = w.length; --n > -1;)if (e[o])for (p = v[w[n]], s = p.length - 1, q = 0; s > q; q++)r = p[q + 1].da / c[q] + p[q].da / b[q], d[q] = (d[q] || 0) + r * r;
                for (n = d.length; --n > -1;)d[n] = Math.sqrt(d[n])
            }
            for (n = w.length, q = h ? 4 : 1; --n > -1;)o = w[n], p = v[o], i(p, f, h, k, e[o]), t && (p.splice(0, q), p.splice(p.length - q, q));
            return v
        }, l = function (a, b, c) {
            b = b || "soft";
            var d, e, g, h, i, j, k, l, m, n, o, p = {}, q = "cubic" === b ? 3 : 2, r = "soft" === b, s = [];
            if (r && c && (a = [c].concat(a)), null == a || a.length < q + 1)throw"invalid Bezier data";
            for (m in a[0])s.push(m);
            for (j = s.length; --j > -1;) {
                for (m = s[j], p[m] = i = [], n = 0, l = a.length, k = 0; l > k; k++)d = null == c ? a[k][m] : "string" == typeof(o = a[k][m]) && "=" === o.charAt(1) ? c[m] + Number(o.charAt(0) + o.substr(2)) : Number(o), r && k > 1 && l - 1 > k && (i[n++] = (d + i[n - 2]) / 2), i[n++] = d;
                for (l = n - q + 1, n = 0, k = 0; l > k; k += q)d = i[k], e = i[k + 1], g = i[k + 2], h = 2 === q ? 0 : i[k + 3], i[n++] = o = 3 === q ? new f(d, e, g, h) : new f(d, (2 * e + d) / 3, (2 * e + g) / 3, g);
                i.length = n
            }
            return p
        }, m = function (a, b, c) {
            for (var d, e, f, g, h, i, j, k, l, m, n, o = 1 / c, p = a.length; --p > -1;)for (m = a[p], f = m.a, g = m.d - f, h = m.c - f, i = m.b - f, d = e = 0, k = 1; c >= k; k++)j = o * k, l = 1 - j, d = e - (e = (j * j * g + 3 * l * (j * h + l * i)) * j), n = p * c + k - 1, b[n] = (b[n] || 0) + d * d
        }, n = function (a, b) {
            b = b >> 0 || 6;
            var c, d, e, f, g = [], h = [], i = 0, j = 0, k = b - 1, l = [], n = [];
            for (c in a)m(a[c], g, b);
            for (e = g.length, d = 0; e > d; d++)i += Math.sqrt(g[d]), f = d % b, n[f] = i, f === k && (j += i, f = d / b >> 0, l[f] = n, h[f] = j, i = 0, n = []);
            return {length: j, lengths: h, segments: l}
        }, o = _gsScope._gsDefine.plugin({
            propName: "bezier",
            priority: -1,
            version: "1.3.3",
            API: 2,
            global: !0,
            init: function (a, b, c) {
                this._target = a, b instanceof Array && (b = {values: b}), this._func = {}, this._round = {}, this._props = [], this._timeRes = null == b.timeResolution ? 6 : parseInt(b.timeResolution, 10);
                var d, e, f, g, h, i = b.values || [], j = {}, m = i[0], o = b.autoRotate || c.vars.orientToBezier;
                this._autoRotate = o ? o instanceof Array ? o : [["x", "y", "rotation", o === !0 ? 0 : Number(o) || 0]] : null;
                for (d in m)this._props.push(d);
                for (f = this._props.length; --f > -1;)d = this._props[f], this._overwriteProps.push(d), e = this._func[d] = "function" == typeof a[d], j[d] = e ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)]() : parseFloat(a[d]), h || j[d] !== i[0][d] && (h = j);
                if (this._beziers = "cubic" !== b.type && "quadratic" !== b.type && "soft" !== b.type ? k(i, isNaN(b.curviness) ? 1 : b.curviness, !1, "thruBasic" === b.type, b.correlate, h) : l(i, b.type, j), this._segCount = this._beziers[d].length, this._timeRes) {
                    var p = n(this._beziers, this._timeRes);
                    this._length = p.length, this._lengths = p.lengths, this._segments = p.segments, this._l1 = this._li = this._s1 = this._si = 0, this._l2 = this._lengths[0], this._curSeg = this._segments[0], this._s2 = this._curSeg[0], this._prec = 1 / this._curSeg.length
                }
                if (o = this._autoRotate)for (this._initialRotations = [], o[0] instanceof Array || (this._autoRotate = o = [o]), f = o.length; --f > -1;) {
                    for (g = 0; 3 > g; g++)d = o[f][g], this._func[d] = "function" == typeof a[d] ? a[d.indexOf("set") || "function" != typeof a["get" + d.substr(3)] ? d : "get" + d.substr(3)] : !1;
                    d = o[f][2], this._initialRotations[f] = this._func[d] ? this._func[d].call(this._target) : this._target[d]
                }
                return this._startRatio = c.vars.runBackwards ? 1 : 0, !0
            },
            set: function (b) {
                var c, d, e, f, g, h, i, j, k, l, m = this._segCount, n = this._func, o = this._target, p = b !== this._startRatio;
                if (this._timeRes) {
                    if (k = this._lengths, l = this._curSeg, b *= this._length, e = this._li, b > this._l2 && m - 1 > e) {
                        for (j = m - 1; j > e && (this._l2 = k[++e]) <= b;);
                        this._l1 = k[e - 1], this._li = e, this._curSeg = l = this._segments[e], this._s2 = l[this._s1 = this._si = 0]
                    } else if (b < this._l1 && e > 0) {
                        for (; e > 0 && (this._l1 = k[--e]) >= b;);
                        0 === e && b < this._l1 ? this._l1 = 0 : e++, this._l2 = k[e], this._li = e, this._curSeg = l = this._segments[e], this._s1 = l[(this._si = l.length - 1) - 1] || 0, this._s2 = l[this._si]
                    }
                    if (c = e, b -= this._l1, e = this._si, b > this._s2 && e < l.length - 1) {
                        for (j = l.length - 1; j > e && (this._s2 = l[++e]) <= b;);
                        this._s1 = l[e - 1], this._si = e
                    } else if (b < this._s1 && e > 0) {
                        for (; e > 0 && (this._s1 = l[--e]) >= b;);
                        0 === e && b < this._s1 ? this._s1 = 0 : e++, this._s2 = l[e], this._si = e
                    }
                    h = (e + (b - this._s1) / (this._s2 - this._s1)) * this._prec
                } else c = 0 > b ? 0 : b >= 1 ? m - 1 : m * b >> 0, h = (b - c * (1 / m)) * m;
                for (d = 1 - h, e = this._props.length; --e > -1;)f = this._props[e], g = this._beziers[f][c], i = (h * h * g.da + 3 * d * (h * g.ca + d * g.ba)) * h + g.a, this._round[f] && (i = Math.round(i)), n[f] ? o[f](i) : o[f] = i;
                if (this._autoRotate) {
                    var q, r, s, t, u, v, w, x = this._autoRotate;
                    for (e = x.length; --e > -1;)f = x[e][2], v = x[e][3] || 0, w = x[e][4] === !0 ? 1 : a, g = this._beziers[x[e][0]], q = this._beziers[x[e][1]], g && q && (g = g[c], q = q[c], r = g.a + (g.b - g.a) * h, t = g.b + (g.c - g.b) * h, r += (t - r) * h, t += (g.c + (g.d - g.c) * h - t) * h, s = q.a + (q.b - q.a) * h, u = q.b + (q.c - q.b) * h, s += (u - s) * h, u += (q.c + (q.d - q.c) * h - u) * h, i = p ? (Math.atan2(u - s, t - r) + 3.1415) * w + v : this._initialRotations[e], n[f] ? o[f](i) : o[f] = i)
                }
            }
        }), p = o.prototype;
        o.bezierThrough = k, o.cubicToQuadratic = h, o._autoCSS = !0, o.quadraticToCubic = function (a, b, c) {
            return new f(a, (2 * b + a) / 3, (2 * b + c) / 3, c)
        }, o._cssRegister = function () {
            var a = _gsScope._gsDefine.globals.CSSPlugin;
            if (a) {
                var b = a._internals, c = b._parseToProxy, d = b._setPluginRatio, e = b.CSSPropTween;
                b._registerComplexSpecialProp("bezier", {
                    parser: function (a, b, f, g, h, i) {
                        b instanceof Array && (b = {values: b}), i = new o;
                        var j, k, l, m = b.values, n = m.length - 1, p = [], q = {};
                        if (0 > n)return h;
                        for (j = 0; n >= j; j++)l = c(a, m[j], g, h, i, n !== j), p[j] = l.end;
                        for (k in b)q[k] = b[k];
                        return q.values = p, h = new e(a, "bezier", 0, 0, l.pt, 2), h.data = l, h.plugin = i, h.setRatio = d, 0 === q.autoRotate && (q.autoRotate = !0), !q.autoRotate || q.autoRotate instanceof Array || (j = q.autoRotate === !0 ? 0 : Number(q.autoRotate), q.autoRotate = null != l.end.left ? [["left", "top", "rotation", j, !1]] : null != l.end.x ? [["x", "y", "rotation", j, !1]] : !1), q.autoRotate && (g._transform || g._enableTransforms(!1), l.autoRotate = g._target._gsTransform), i._onInitTween(l.proxy, q, g._tween), h
                    }
                })
            }
        }, p._roundProps = function (a, b) {
            for (var c = this._overwriteProps, d = c.length; --d > -1;)(a[c[d]] || a.bezier || a.bezierThrough) && (this._round[c[d]] = b)
        }, p._kill = function (a) {
            var b, c, d = this._props;
            for (b in this._beziers)if (b in a)for (delete this._beziers[b], delete this._func[b], c = d.length; --c > -1;)d[c] === b && d.splice(c, 1);
            return this._super._kill.call(this, a)
        }
    }(), _gsScope._gsDefine("plugins.CSSPlugin", ["plugins.TweenPlugin", "TweenLite"], function (a, b) {
        var c, d, e, f, g = function () {
            a.call(this, "css"), this._overwriteProps.length = 0, this.setRatio = g.prototype.setRatio
        }, h = {}, i = g.prototype = new a("css");
        i.constructor = g, g.version = "1.13.2", g.API = 2, g.defaultTransformPerspective = 0, g.defaultSkewType = "compensated", i = "px", g.suffixMap = {
            top: i,
            right: i,
            bottom: i,
            left: i,
            width: i,
            height: i,
            fontSize: i,
            padding: i,
            margin: i,
            perspective: i,
            lineHeight: ""
        };
        var j, k, l, m, n, o, p = /(?:\d|\-\d|\.\d|\-\.\d)+/g, q = /(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g, r = /(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi, s = /[^\d\-\.]/g, t = /(?:\d|\-|\+|=|#|\.)*/g, u = /opacity *= *([^)]*)/i, v = /opacity:([^;]*)/i, w = /alpha\(opacity *=.+?\)/i, x = /^(rgb|hsl)/, y = /([A-Z])/g, z = /-([a-z])/gi, A = /(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi, B = function (a, b) {
            return b.toUpperCase()
        }, C = /(?:Left|Right|Width)/i, D = /(M11|M12|M21|M22)=[\d\-\.e]+/gi, E = /progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i, F = /,(?=[^\)]*(?:\(|$))/gi, G = Math.PI / 180, H = 180 / Math.PI, I = {}, J = document, K = J.createElement("div"), L = J.createElement("img"), M = g._internals = {_specialProps: h}, N = navigator.userAgent, O = function () {
            var a, b = N.indexOf("Android"), c = J.createElement("div");
            return l = -1 !== N.indexOf("Safari") && -1 === N.indexOf("Chrome") && (-1 === b || Number(N.substr(b + 8, 1)) > 3), n = l && Number(N.substr(N.indexOf("Version/") + 8, 1)) < 6, m = -1 !== N.indexOf("Firefox"), /MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(N) && (o = parseFloat(RegExp.$1)), c.innerHTML = "<a style='top:1px;opacity:.55;'>a</a>", a = c.getElementsByTagName("a")[0], a ? /^0.55/.test(a.style.opacity) : !1
        }(), P = function (a) {
            return u.test("string" == typeof a ? a : (a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? parseFloat(RegExp.$1) / 100 : 1
        }, Q = function (a) {
            window.console
        }, R = "", S = "", T = function (a, b) {
            b = b || K;
            var c, d, e = b.style;
            if (void 0 !== e[a])return a;
            for (a = a.charAt(0).toUpperCase() + a.substr(1), c = ["O", "Moz", "ms", "Ms", "Webkit"], d = 5; --d > -1 && void 0 === e[c[d] + a];);
            return d >= 0 ? (S = 3 === d ? "ms" : c[d], R = "-" + S.toLowerCase() + "-", S + a) : null
        }, U = J.defaultView ? J.defaultView.getComputedStyle : function () {
        }, V = g.getStyle = function (a, b, c, d, e) {
            var f;
            return O || "opacity" !== b ? (!d && a.style[b] ? f = a.style[b] : (c = c || U(a)) ? f = c[b] || c.getPropertyValue(b) || c.getPropertyValue(b.replace(y, "-$1").toLowerCase()) : a.currentStyle && (f = a.currentStyle[b]), null == e || f && "none" !== f && "auto" !== f && "auto auto" !== f ? f : e) : P(a)
        }, W = M.convertToPixels = function (a, c, d, e, f) {
            if ("px" === e || !e)return d;
            if ("auto" === e || !d)return 0;
            var h, i, j, k = C.test(c), l = a, m = K.style, n = 0 > d;
            if (n && (d = -d), "%" === e && -1 !== c.indexOf("border"))h = d / 100 * (k ? a.clientWidth : a.clientHeight); else {
                if (m.cssText = "border:0 solid red;position:" + V(a, "position") + ";line-height:0;", "%" !== e && l.appendChild)m[k ? "borderLeftWidth" : "borderTopWidth"] = d + e; else {
                    if (l = a.parentNode || J.body, i = l._gsCache, j = b.ticker.frame, i && k && i.time === j)return i.width * d / 100;
                    m[k ? "width" : "height"] = d + e
                }
                l.appendChild(K), h = parseFloat(K[k ? "offsetWidth" : "offsetHeight"]), l.removeChild(K), k && "%" === e && g.cacheWidths !== !1 && (i = l._gsCache = l._gsCache || {}, i.time = j, i.width = h / d * 100), 0 !== h || f || (h = W(a, c, d, e, !0))
            }
            return n ? -h : h
        }, X = M.calculateOffset = function (a, b, c) {
            if ("absolute" !== V(a, "position", c))return 0;
            var d = "left" === b ? "Left" : "Top", e = V(a, "margin" + d, c);
            return a["offset" + d] - (W(a, b, parseFloat(e), e.replace(t, "")) || 0)
        }, Y = function (a, b) {
            var c, d, e = {};
            if (b = b || U(a, null))if (c = b.length)for (; --c > -1;)e[b[c].replace(z, B)] = b.getPropertyValue(b[c]); else for (c in b)e[c] = b[c]; else if (b = a.currentStyle || a.style)for (c in b)"string" == typeof c && void 0 === e[c] && (e[c.replace(z, B)] = b[c]);
            return O || (e.opacity = P(a)), d = yb(a, b, !1), e.rotation = d.rotation, e.skewX = d.skewX, e.scaleX = d.scaleX, e.scaleY = d.scaleY, e.x = d.x, e.y = d.y, wb && (e.z = d.z, e.rotationX = d.rotationX, e.rotationY = d.rotationY, e.scaleZ = d.scaleZ), e.filters && delete e.filters, e
        }, Z = function (a, b, c, d, e) {
            var f, g, h, i = {}, j = a.style;
            for (g in c)"cssText" !== g && "length" !== g && isNaN(g) && (b[g] !== (f = c[g]) || e && e[g]) && -1 === g.indexOf("Origin") && ("number" == typeof f || "string" == typeof f) && (i[g] = "auto" !== f || "left" !== g && "top" !== g ? "" !== f && "auto" !== f && "none" !== f || "string" != typeof b[g] || "" === b[g].replace(s, "") ? f : 0 : X(a, g), void 0 !== j[g] && (h = new lb(j, g, j[g], h)));
            if (d)for (g in d)"className" !== g && (i[g] = d[g]);
            return {difs: i, firstMPT: h}
        }, $ = {
            width: ["Left", "Right"],
            height: ["Top", "Bottom"]
        }, _ = ["marginLeft", "marginRight", "marginTop", "marginBottom"], ab = function (a, b, c) {
            var d = parseFloat("width" === b ? a.offsetWidth : a.offsetHeight), e = $[b], f = e.length;
            for (c = c || U(a, null); --f > -1;)d -= parseFloat(V(a, "padding" + e[f], c, !0)) || 0, d -= parseFloat(V(a, "border" + e[f] + "Width", c, !0)) || 0;
            return d
        }, bb = function (a, b) {
            (null == a || "" === a || "auto" === a || "auto auto" === a) && (a = "0 0");
            var c = a.split(" "), d = -1 !== a.indexOf("left") ? "0%" : -1 !== a.indexOf("right") ? "100%" : c[0], e = -1 !== a.indexOf("top") ? "0%" : -1 !== a.indexOf("bottom") ? "100%" : c[1];
            return null == e ? e = "0" : "center" === e && (e = "50%"), ("center" === d || isNaN(parseFloat(d)) && -1 === (d + "").indexOf("=")) && (d = "50%"), b && (b.oxp = -1 !== d.indexOf("%"), b.oyp = -1 !== e.indexOf("%"), b.oxr = "=" === d.charAt(1), b.oyr = "=" === e.charAt(1), b.ox = parseFloat(d.replace(s, "")), b.oy = parseFloat(e.replace(s, ""))), d + " " + e + (c.length > 2 ? " " + c[2] : "")
        }, cb = function (a, b) {
            return "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * parseFloat(a.substr(2)) : parseFloat(a) - parseFloat(b)
        }, db = function (a, b) {
            return null == a ? b : "string" == typeof a && "=" === a.charAt(1) ? parseInt(a.charAt(0) + "1", 10) * Number(a.substr(2)) + b : parseFloat(a)
        }, eb = function (a, b, c, d) {
            var e, f, g, h, i = 1e-6;
            return null == a ? h = b : "number" == typeof a ? h = a : (e = 360, f = a.split("_"), g = Number(f[0].replace(s, "")) * (-1 === a.indexOf("rad") ? 1 : H) - ("=" === a.charAt(1) ? 0 : b), f.length && (d && (d[c] = b + g), -1 !== a.indexOf("short") && (g %= e, g !== g % (e / 2) && (g = 0 > g ? g + e : g - e)), -1 !== a.indexOf("_cw") && 0 > g ? g = (g + 9999999999 * e) % e - (g / e | 0) * e : -1 !== a.indexOf("ccw") && g > 0 && (g = (g - 9999999999 * e) % e - (g / e | 0) * e)), h = b + g), i > h && h > -i && (h = 0), h
        }, fb = {
            aqua: [0, 255, 255],
            lime: [0, 255, 0],
            silver: [192, 192, 192],
            black: [0, 0, 0],
            maroon: [128, 0, 0],
            teal: [0, 128, 128],
            blue: [0, 0, 255],
            navy: [0, 0, 128],
            white: [255, 255, 255],
            fuchsia: [255, 0, 255],
            olive: [128, 128, 0],
            yellow: [255, 255, 0],
            orange: [255, 165, 0],
            gray: [128, 128, 128],
            purple: [128, 0, 128],
            green: [0, 128, 0],
            red: [255, 0, 0],
            pink: [255, 192, 203],
            cyan: [0, 255, 255],
            transparent: [255, 255, 255, 0]
        }, gb = function (a, b, c) {
            return a = 0 > a ? a + 1 : a > 1 ? a - 1 : a, 255 * (1 > 6 * a ? b + (c - b) * a * 6 : .5 > a ? c : 2 > 3 * a ? b + (c - b) * (2 / 3 - a) * 6 : b) + .5 | 0
        }, hb = function (a) {
            var b, c, d, e, f, g;
            return a && "" !== a ? "number" == typeof a ? [a >> 16, a >> 8 & 255, 255 & a] : ("," === a.charAt(a.length - 1) && (a = a.substr(0, a.length - 1)), fb[a] ? fb[a] : "#" === a.charAt(0) ? (4 === a.length && (b = a.charAt(1), c = a.charAt(2), d = a.charAt(3), a = "#" + b + b + c + c + d + d), a = parseInt(a.substr(1), 16), [a >> 16, a >> 8 & 255, 255 & a]) : "hsl" === a.substr(0, 3) ? (a = a.match(p), e = Number(a[0]) % 360 / 360, f = Number(a[1]) / 100, g = Number(a[2]) / 100, c = .5 >= g ? g * (f + 1) : g + f - g * f, b = 2 * g - c, a.length > 3 && (a[3] = Number(a[3])), a[0] = gb(e + 1 / 3, b, c), a[1] = gb(e, b, c), a[2] = gb(e - 1 / 3, b, c), a) : (a = a.match(p) || fb.transparent, a[0] = Number(a[0]), a[1] = Number(a[1]), a[2] = Number(a[2]), a.length > 3 && (a[3] = Number(a[3])), a)) : fb.black
        }, ib = "(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";
        for (i in fb)ib += "|" + i + "\\b";
        ib = new RegExp(ib + ")", "gi");
        var jb = function (a, b, c, d) {
            if (null == a)return function (a) {
                return a
            };
            var e, f = b ? (a.match(ib) || [""])[0] : "", g = a.split(f).join("").match(r) || [], h = a.substr(0, a.indexOf(g[0])), i = ")" === a.charAt(a.length - 1) ? ")" : "", j = -1 !== a.indexOf(" ") ? " " : ",", k = g.length, l = k > 0 ? g[0].replace(p, "") : "";
            return k ? e = b ? function (a) {
                var b, m, n, o;
                if ("number" == typeof a)a += l; else if (d && F.test(a)) {
                    for (o = a.replace(F, "|").split("|"), n = 0; n < o.length; n++)o[n] = e(o[n]);
                    return o.join(",")
                }
                if (b = (a.match(ib) || [f])[0], m = a.split(b).join("").match(r) || [], n = m.length, k > n--)for (; ++n < k;)m[n] = c ? m[(n - 1) / 2 | 0] : g[n];
                return h + m.join(j) + j + b + i + (-1 !== a.indexOf("inset") ? " inset" : "")
            } : function (a) {
                var b, f, m;
                if ("number" == typeof a)a += l; else if (d && F.test(a)) {
                    for (f = a.replace(F, "|").split("|"), m = 0; m < f.length; m++)f[m] = e(f[m]);
                    return f.join(",")
                }
                if (b = a.match(r) || [], m = b.length, k > m--)for (; ++m < k;)b[m] = c ? b[(m - 1) / 2 | 0] : g[m];
                return h + b.join(j) + i
            } : function (a) {
                return a
            }
        }, kb = function (a) {
            return a = a.split(","), function (b, c, d, e, f, g, h) {
                var i, j = (c + "").split(" ");
                for (h = {}, i = 0; 4 > i; i++)h[a[i]] = j[i] = j[i] || j[(i - 1) / 2 >> 0];
                return e.parse(b, h, f, g)
            }
        }, lb = (M._setPluginRatio = function (a) {
            this.plugin.setRatio(a);
            for (var b, c, d, e, f = this.data, g = f.proxy, h = f.firstMPT, i = 1e-6; h;)b = g[h.v], h.r ? b = Math.round(b) : i > b && b > -i && (b = 0), h.t[h.p] = b, h = h._next;
            if (f.autoRotate && (f.autoRotate.rotation = g.rotation), 1 === a)for (h = f.firstMPT; h;) {
                if (c = h.t, c.type) {
                    if (1 === c.type) {
                        for (e = c.xs0 + c.s + c.xs1, d = 1; d < c.l; d++)e += c["xn" + d] + c["xs" + (d + 1)];
                        c.e = e
                    }
                } else c.e = c.s + c.xs0;
                h = h._next
            }
        }, function (a, b, c, d, e) {
            this.t = a, this.p = b, this.v = c, this.r = e, d && (d._prev = this, this._next = d)
        }), mb = (M._parseToProxy = function (a, b, c, d, e, f) {
            var g, h, i, j, k, l = d, m = {}, n = {}, o = c._transform, p = I;
            for (c._transform = null, I = b, d = k = c.parse(a, b, d, e), I = p, f && (c._transform = o, l && (l._prev = null, l._prev && (l._prev._next = null))); d && d !== l;) {
                if (d.type <= 1 && (h = d.p, n[h] = d.s + d.c, m[h] = d.s, f || (j = new lb(d, "s", h, j, d.r), d.c = 0), 1 === d.type))for (g = d.l; --g > 0;)i = "xn" + g, h = d.p + "_" + i, n[h] = d.data[i], m[h] = d[i], f || (j = new lb(d, i, h, j, d.rxp[i]));
                d = d._next
            }
            return {proxy: m, end: n, firstMPT: j, pt: k}
        }, M.CSSPropTween = function (a, b, d, e, g, h, i, j, k, l, m) {
            this.t = a, this.p = b, this.s = d, this.c = e, this.n = i || b, a instanceof mb || f.push(this.n), this.r = j, this.type = h || 0, k && (this.pr = k, c = !0), this.b = void 0 === l ? d : l, this.e = void 0 === m ? d + e : m, g && (this._next = g, g._prev = this)
        }), nb = g.parseComplex = function (a, b, c, d, e, f, g, h, i, k) {
            c = c || f || "", g = new mb(a, b, 0, 0, g, k ? 2 : 1, null, !1, h, c, d), d += "";
            var l, m, n, o, r, s, t, u, v, w, y, z, A = c.split(", ").join(",").split(" "), B = d.split(", ").join(",").split(" "), C = A.length, D = j !== !1;
            for ((-1 !== d.indexOf(",") || -1 !== c.indexOf(",")) && (A = A.join(" ").replace(F, ", ").split(" "), B = B.join(" ").replace(F, ", ").split(" "), C = A.length), C !== B.length && (A = (f || "").split(" "), C = A.length), g.plugin = i, g.setRatio = k, l = 0; C > l; l++)if (o = A[l], r = B[l], u = parseFloat(o), u || 0 === u)g.appendXtra("", u, cb(r, u), r.replace(q, ""), D && -1 !== r.indexOf("px"), !0); else if (e && ("#" === o.charAt(0) || fb[o] || x.test(o)))z = "," === r.charAt(r.length - 1) ? ")," : ")", o = hb(o), r = hb(r), v = o.length + r.length > 6, v && !O && 0 === r[3] ? (g["xs" + g.l] += g.l ? " transparent" : "transparent", g.e = g.e.split(B[l]).join("transparent")) : (O || (v = !1), g.appendXtra(v ? "rgba(" : "rgb(", o[0], r[0] - o[0], ",", !0, !0).appendXtra("", o[1], r[1] - o[1], ",", !0).appendXtra("", o[2], r[2] - o[2], v ? "," : z, !0), v && (o = o.length < 4 ? 1 : o[3], g.appendXtra("", o, (r.length < 4 ? 1 : r[3]) - o, z, !1))); else if (s = o.match(p)) {
                if (t = r.match(q), !t || t.length !== s.length)return g;
                for (n = 0, m = 0; m < s.length; m++)y = s[m], w = o.indexOf(y, n), g.appendXtra(o.substr(n, w - n), Number(y), cb(t[m], y), "", D && "px" === o.substr(w + y.length, 2), 0 === m), n = w + y.length;
                g["xs" + g.l] += o.substr(n)
            } else g["xs" + g.l] += g.l ? " " + o : o;
            if (-1 !== d.indexOf("=") && g.data) {
                for (z = g.xs0 + g.data.s, l = 1; l < g.l; l++)z += g["xs" + l] + g.data["xn" + l];
                g.e = z + g["xs" + l]
            }
            return g.l || (g.type = -1, g.xs0 = g.e), g.xfirst || g
        }, ob = 9;
        for (i = mb.prototype, i.l = i.pr = 0; --ob > 0;)i["xn" + ob] = 0, i["xs" + ob] = "";
        i.xs0 = "", i._next = i._prev = i.xfirst = i.data = i.plugin = i.setRatio = i.rxp = null, i.appendXtra = function (a, b, c, d, e, f) {
            var g = this, h = g.l;
            return g["xs" + h] += f && h ? " " + a : a || "", c || 0 === h || g.plugin ? (g.l++, g.type = g.setRatio ? 2 : 1, g["xs" + g.l] = d || "", h > 0 ? (g.data["xn" + h] = b + c, g.rxp["xn" + h] = e, g["xn" + h] = b, g.plugin || (g.xfirst = new mb(g, "xn" + h, b, c, g.xfirst || g, 0, g.n, e, g.pr), g.xfirst.xs0 = 0), g) : (g.data = {s: b + c}, g.rxp = {}, g.s = b, g.c = c, g.r = e, g)) : (g["xs" + h] += b + (d || ""), g)
        };
        var pb = function (a, b) {
            b = b || {}, this.p = b.prefix ? T(a) || a : a, h[a] = h[this.p] = this, this.format = b.formatter || jb(b.defaultValue, b.color, b.collapsible, b.multi), b.parser && (this.parse = b.parser), this.clrs = b.color, this.multi = b.multi, this.keyword = b.keyword, this.dflt = b.defaultValue, this.pr = b.priority || 0
        }, qb = M._registerComplexSpecialProp = function (a, b, c) {
            "object" != typeof b && (b = {parser: c});
            var d, e, f = a.split(","), g = b.defaultValue;
            for (c = c || [g], d = 0; d < f.length; d++)b.prefix = 0 === d && b.prefix, b.defaultValue = c[d] || g, e = new pb(f[d], b)
        }, rb = function (a) {
            if (!h[a]) {
                var b = a.charAt(0).toUpperCase() + a.substr(1) + "Plugin";
                qb(a, {
                    parser: function (a, c, d, e, f, g, i) {
                        var j = (_gsScope.GreenSockGlobals || _gsScope).com.greensock.plugins[b];
                        return j ? (j._cssRegister(), h[d].parse(a, c, d, e, f, g, i)) : (Q("Error: " + b + " js file not loaded."), f)
                    }
                })
            }
        };
        i = pb.prototype, i.parseComplex = function (a, b, c, d, e, f) {
            var g, h, i, j, k, l, m = this.keyword;
            if (this.multi && (F.test(c) || F.test(b) ? (h = b.replace(F, "|").split("|"), i = c.replace(F, "|").split("|")) : m && (h = [b], i = [c])), i) {
                for (j = i.length > h.length ? i.length : h.length, g = 0; j > g; g++)b = h[g] = h[g] || this.dflt, c = i[g] = i[g] || this.dflt, m && (k = b.indexOf(m), l = c.indexOf(m), k !== l && (c = -1 === l ? i : h, c[g] += " " + m));
                b = h.join(", "), c = i.join(", ")
            }
            return nb(a, this.p, b, c, this.clrs, this.dflt, d, this.pr, e, f)
        }, i.parse = function (a, b, c, d, f, g) {
            return this.parseComplex(a.style, this.format(V(a, this.p, e, !1, this.dflt)), this.format(b), f, g)
        }, g.registerSpecialProp = function (a, b, c) {
            qb(a, {
                parser: function (a, d, e, f, g, h) {
                    var i = new mb(a, e, 0, 0, g, 2, e, !1, c);
                    return i.plugin = h, i.setRatio = b(a, d, f._tween, e), i
                }, priority: c
            })
        };
        var sb = "scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective,xPercent,yPercent".split(","), tb = T("transform"), ub = R + "transform", vb = T("transformOrigin"), wb = null !== T("perspective"), xb = M.Transform = function () {
            this.skewY = 0
        }, yb = M.getTransform = function (a, b, c, d) {
            if (a._gsTransform && c && !d)return a._gsTransform;
            var e, f, h, i, j, k, l, m, n, o, p, q, r, s = c ? a._gsTransform || new xb : new xb, t = s.scaleX < 0, u = 2e-5, v = 1e5, w = 179.99, x = w * G, y = wb ? parseFloat(V(a, vb, b, !1, "0 0 0").split(" ")[2]) || s.zOrigin || 0 : 0, z = parseFloat(g.defaultTransformPerspective) || 0;
            if (tb ? e = V(a, ub, b, !0) : a.currentStyle && (e = a.currentStyle.filter.match(D), e = e && 4 === e.length ? [e[0].substr(4), Number(e[2].substr(4)), Number(e[1].substr(4)), e[3].substr(4), s.x || 0, s.y || 0].join(",") : ""), e && "none" !== e && "matrix(1, 0, 0, 1, 0, 0)" !== e) {
                for (f = (e || "").match(/(?:\-|\b)[\d\-\.e]+\b/gi) || [], h = f.length; --h > -1;)i = Number(f[h]), f[h] = (j = i - (i |= 0)) ? (j * v + (0 > j ? -.5 : .5) | 0) / v + i : i;
                if (16 === f.length) {
                    var A = f[8], B = f[9], C = f[10], E = f[12], F = f[13], I = f[14];
                    if (s.zOrigin && (I = -s.zOrigin, E = A * I - f[12], F = B * I - f[13], I = C * I + s.zOrigin - f[14]), !c || d || null == s.rotationX) {
                        var J, K, L, M, N, O, P, Q = f[0], R = f[1], S = f[2], T = f[3], U = f[4], W = f[5], X = f[6], Y = f[7], Z = f[11], $ = Math.atan2(X, C), _ = -x > $ || $ > x;
                        s.rotationX = $ * H, $ && (M = Math.cos(-$), N = Math.sin(-$), J = U * M + A * N, K = W * M + B * N, L = X * M + C * N, A = U * -N + A * M, B = W * -N + B * M, C = X * -N + C * M, Z = Y * -N + Z * M, U = J, W = K, X = L), $ = Math.atan2(A, Q), s.rotationY = $ * H, $ && (O = -x > $ || $ > x, M = Math.cos(-$), N = Math.sin(-$), J = Q * M - A * N, K = R * M - B * N, L = S * M - C * N, B = R * N + B * M, C = S * N + C * M, Z = T * N + Z * M, Q = J, R = K, S = L), $ = Math.atan2(R, W), s.rotation = $ * H, $ && (P = -x > $ || $ > x, M = Math.cos(-$), N = Math.sin(-$), Q = Q * M + U * N, K = R * M + W * N, W = R * -N + W * M, X = S * -N + X * M, R = K), P && _ ? s.rotation = s.rotationX = 0 : P && O ? s.rotation = s.rotationY = 0 : O && _ && (s.rotationY = s.rotationX = 0), s.scaleX = (Math.sqrt(Q * Q + R * R) * v + .5 | 0) / v, s.scaleY = (Math.sqrt(W * W + B * B) * v + .5 | 0) / v, s.scaleZ = (Math.sqrt(X * X + C * C) * v + .5 | 0) / v, s.skewX = 0, s.perspective = Z ? 1 / (0 > Z ? -Z : Z) : 0, s.x = E, s.y = F, s.z = I
                    }
                } else if (!(wb && !d && f.length && s.x === f[4] && s.y === f[5] && (s.rotationX || s.rotationY) || void 0 !== s.x && "none" === V(a, "display", b))) {
                    var ab = f.length >= 6, bb = ab ? f[0] : 1, cb = f[1] || 0, db = f[2] || 0, eb = ab ? f[3] : 1;
                    s.x = f[4] || 0, s.y = f[5] || 0, k = Math.sqrt(bb * bb + cb * cb), l = Math.sqrt(eb * eb + db * db), m = bb || cb ? Math.atan2(cb, bb) * H : s.rotation || 0, n = db || eb ? Math.atan2(db, eb) * H + m : s.skewX || 0, o = k - Math.abs(s.scaleX || 0), p = l - Math.abs(s.scaleY || 0), Math.abs(n) > 90 && Math.abs(n) < 270 && (t ? (k *= -1, n += 0 >= m ? 180 : -180, m += 0 >= m ? 180 : -180) : (l *= -1, n += 0 >= n ? 180 : -180)), q = (m - s.rotation) % 180, r = (n - s.skewX) % 180, (void 0 === s.skewX || o > u || -u > o || p > u || -u > p || q > -w && w > q && q * v | !1 || r > -w && w > r && r * v | !1) && (s.scaleX = k, s.scaleY = l, s.rotation = m, s.skewX = n), wb && (s.rotationX = s.rotationY = s.z = 0, s.perspective = z, s.scaleZ = 1)
                }
                s.zOrigin = y;
                for (h in s)s[h] < u && s[h] > -u && (s[h] = 0)
            } else s = {
                x: 0,
                y: 0,
                z: 0,
                scaleX: 1,
                scaleY: 1,
                scaleZ: 1,
                skewX: 0,
                perspective: z,
                rotation: 0,
                rotationX: 0,
                rotationY: 0,
                zOrigin: 0
            };
            return c && (a._gsTransform = s), s.xPercent = s.yPercent = 0, s
        }, zb = function (a) {
            var b, c, d = this.data, e = -d.rotation * G, f = e + d.skewX * G, g = 1e5, h = (Math.cos(e) * d.scaleX * g | 0) / g, i = (Math.sin(e) * d.scaleX * g | 0) / g, j = (Math.sin(f) * -d.scaleY * g | 0) / g, k = (Math.cos(f) * d.scaleY * g | 0) / g, l = this.t.style, m = this.t.currentStyle;
            if (m) {
                c = i, i = -j, j = -c, b = m.filter, l.filter = "";
                var n, p, q = this.t.offsetWidth, r = this.t.offsetHeight, s = "absolute" !== m.position, v = "progid:DXImageTransform.Microsoft.Matrix(M11=" + h + ", M12=" + i + ", M21=" + j + ", M22=" + k, w = d.x + q * d.xPercent / 100, x = d.y + r * d.yPercent / 100;
                if (null != d.ox && (n = (d.oxp ? q * d.ox * .01 : d.ox) - q / 2, p = (d.oyp ? r * d.oy * .01 : d.oy) - r / 2, w += n - (n * h + p * i), x += p - (n * j + p * k)), s ? (n = q / 2, p = r / 2, v += ", Dx=" + (n - (n * h + p * i) + w) + ", Dy=" + (p - (n * j + p * k) + x) + ")") : v += ", sizingMethod='auto expand')", l.filter = -1 !== b.indexOf("DXImageTransform.Microsoft.Matrix(") ? b.replace(E, v) : v + " " + b, (0 === a || 1 === a) && 1 === h && 0 === i && 0 === j && 1 === k && (s && -1 === v.indexOf("Dx=0, Dy=0") || u.test(b) && 100 !== parseFloat(RegExp.$1) || -1 === b.indexOf("gradient(" && b.indexOf("Alpha")) && l.removeAttribute("filter")), !s) {
                    var y, z, A, B = 8 > o ? 1 : -1;
                    for (n = d.ieOffsetX || 0, p = d.ieOffsetY || 0, d.ieOffsetX = Math.round((q - ((0 > h ? -h : h) * q + (0 > i ? -i : i) * r)) / 2 + w), d.ieOffsetY = Math.round((r - ((0 > k ? -k : k) * r + (0 > j ? -j : j) * q)) / 2 + x), ob = 0; 4 > ob; ob++)z = _[ob], y = m[z], c = -1 !== y.indexOf("px") ? parseFloat(y) : W(this.t, z, parseFloat(y), y.replace(t, "")) || 0, A = c !== d[z] ? 2 > ob ? -d.ieOffsetX : -d.ieOffsetY : 2 > ob ? n - d.ieOffsetX : p - d.ieOffsetY, l[z] = (d[z] = Math.round(c - A * (0 === ob || 2 === ob ? 1 : B))) + "px"
                }
            }
        }, Ab = M.set3DTransformRatio = function (a) {
            var b, c, d, e, f, g, h, i, j, k, l, n, o, p, q, r, s, t, u, v, w, x, y, z = this.data, A = this.t.style, B = z.rotation * G, C = z.scaleX, D = z.scaleY, E = z.scaleZ, F = z.x, H = z.y, I = z.z, J = z.perspective;
            if ((1 === a || 0 === a) && "auto" === z.force3D && !(z.rotationY || z.rotationX || 1 !== E || J || I))return void Bb.call(this, a);
            if (m) {
                var K = 1e-4;
                K > C && C > -K && (C = E = 2e-5), K > D && D > -K && (D = E = 2e-5), !J || z.z || z.rotationX || z.rotationY || (J = 0)
            }
            if (B || z.skewX)t = Math.cos(B), u = Math.sin(B), b = t, f = u, z.skewX && (B -= z.skewX * G, t = Math.cos(B), u = Math.sin(B), "simple" === z.skewType && (v = Math.tan(z.skewX * G), v = Math.sqrt(1 + v * v), t *= v, u *= v)), c = -u, g = t; else {
                if (!(z.rotationY || z.rotationX || 1 !== E || J))return void(A[tb] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) translate3d(" : "translate3d(") + F + "px," + H + "px," + I + "px)" + (1 !== C || 1 !== D ? " scale(" + C + "," + D + ")" : ""));
                b = g = 1, c = f = 0
            }
            l = 1, d = e = h = i = j = k = n = o = p = 0, q = J ? -1 / J : 0, r = z.zOrigin, s = 1e5, B = z.rotationY * G, B && (t = Math.cos(B), u = Math.sin(B), j = l * -u, o = q * -u, d = b * u, h = f * u, l *= t, q *= t, b *= t, f *= t), B = z.rotationX * G, B && (t = Math.cos(B), u = Math.sin(B), v = c * t + d * u, w = g * t + h * u, x = k * t + l * u, y = p * t + q * u, d = c * -u + d * t, h = g * -u + h * t, l = k * -u + l * t, q = p * -u + q * t, c = v, g = w, k = x, p = y), 1 !== E && (d *= E, h *= E, l *= E, q *= E), 1 !== D && (c *= D, g *= D, k *= D, p *= D), 1 !== C && (b *= C, f *= C, j *= C, o *= C), r && (n -= r, e = d * n, i = h * n, n = l * n + r), e = (v = (e += F) - (e |= 0)) ? (v * s + (0 > v ? -.5 : .5) | 0) / s + e : e, i = (v = (i += H) - (i |= 0)) ? (v * s + (0 > v ? -.5 : .5) | 0) / s + i : i, n = (v = (n += I) - (n |= 0)) ? (v * s + (0 > v ? -.5 : .5) | 0) / s + n : n, A[tb] = (z.xPercent || z.yPercent ? "translate(" + z.xPercent + "%," + z.yPercent + "%) matrix3d(" : "matrix3d(") + [(b * s | 0) / s, (f * s | 0) / s, (j * s | 0) / s, (o * s | 0) / s, (c * s | 0) / s, (g * s | 0) / s, (k * s | 0) / s, (p * s | 0) / s, (d * s | 0) / s, (h * s | 0) / s, (l * s | 0) / s, (q * s | 0) / s, e, i, n, J ? 1 + -n / J : 1].join(",") + ")"
        }, Bb = M.set2DTransformRatio = function (a) {
            var b, c, d, e, f, g = this.data, h = this.t, i = h.style, j = g.x, k = g.y;
            return g.rotationX || g.rotationY || g.z || g.force3D === !0 || "auto" === g.force3D && 1 !== a && 0 !== a ? (this.setRatio = Ab, void Ab.call(this, a)) : void(g.rotation || g.skewX ? (b = g.rotation * G, c = b - g.skewX * G, d = 1e5, e = g.scaleX * d, f = g.scaleY * d, i[tb] = (g.xPercent || g.yPercent ? "translate(" + g.xPercent + "%," + g.yPercent + "%) matrix(" : "matrix(") + (Math.cos(b) * e | 0) / d + "," + (Math.sin(b) * e | 0) / d + "," + (Math.sin(c) * -f | 0) / d + "," + (Math.cos(c) * f | 0) / d + "," + j + "," + k + ")") : i[tb] = (g.xPercent || g.yPercent ? "translate(" + g.xPercent + "%," + g.yPercent + "%) matrix(" : "matrix(") + g.scaleX + ",0,0," + g.scaleY + "," + j + "," + k + ")")
        };
        qb("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType,xPercent,yPercent", {
            parser: function (a, b, c, d, f, h, i) {
                if (d._transform)return f;
                var j, k, l, m, n, o, p, q = d._transform = yb(a, e, !0, i.parseTransform), r = a.style, s = 1e-6, t = sb.length, u = i, v = {};
                if ("string" == typeof u.transform && tb)l = K.style, l[tb] = u.transform, l.display = "block", l.position = "absolute", J.body.appendChild(K), j = yb(K, null, !1), J.body.removeChild(K); else if ("object" == typeof u) {
                    if (j = {
                            scaleX: db(null != u.scaleX ? u.scaleX : u.scale, q.scaleX),
                            scaleY: db(null != u.scaleY ? u.scaleY : u.scale, q.scaleY),
                            scaleZ: db(u.scaleZ, q.scaleZ),
                            x: db(u.x, q.x),
                            y: db(u.y, q.y),
                            z: db(u.z, q.z),
                            xPercent: db(u.xPercent, q.xPercent),
                            yPercent: db(u.yPercent, q.yPercent),
                            perspective: db(u.transformPerspective, q.perspective)
                        }, p = u.directionalRotation, null != p)if ("object" == typeof p)for (l in p)u[l] = p[l]; else u.rotation = p;
                    "string" == typeof u.x && -1 !== u.x.indexOf("%") && (j.x = 0, j.xPercent = db(u.x, q.xPercent)), "string" == typeof u.y && -1 !== u.y.indexOf("%") && (j.y = 0, j.yPercent = db(u.y, q.yPercent)), j.rotation = eb("rotation" in u ? u.rotation : "shortRotation" in u ? u.shortRotation + "_short" : "rotationZ" in u ? u.rotationZ : q.rotation, q.rotation, "rotation", v), wb && (j.rotationX = eb("rotationX" in u ? u.rotationX : "shortRotationX" in u ? u.shortRotationX + "_short" : q.rotationX || 0, q.rotationX, "rotationX", v), j.rotationY = eb("rotationY" in u ? u.rotationY : "shortRotationY" in u ? u.shortRotationY + "_short" : q.rotationY || 0, q.rotationY, "rotationY", v)), j.skewX = null == u.skewX ? q.skewX : eb(u.skewX, q.skewX), j.skewY = null == u.skewY ? q.skewY : eb(u.skewY, q.skewY), (k = j.skewY - q.skewY) && (j.skewX += k, j.rotation += k)
                }
                for (wb && null != u.force3D && (q.force3D = u.force3D, o = !0), q.skewType = u.skewType || q.skewType || g.defaultSkewType, n = q.force3D || q.z || q.rotationX || q.rotationY || j.z || j.rotationX || j.rotationY || j.perspective, n || null == u.scale || (j.scaleZ = 1); --t > -1;)c = sb[t], m = j[c] - q[c], (m > s || -s > m || null != I[c]) && (o = !0, f = new mb(q, c, q[c], m, f), c in v && (f.e = v[c]), f.xs0 = 0, f.plugin = h, d._overwriteProps.push(f.n));
                return m = u.transformOrigin, (m || wb && n && q.zOrigin) && (tb ? (o = !0, c = vb, m = (m || V(a, c, e, !1, "50% 50%")) + "", f = new mb(r, c, 0, 0, f, -1, "transformOrigin"), f.b = r[c], f.plugin = h, wb ? (l = q.zOrigin, m = m.split(" "), q.zOrigin = (m.length > 2 && (0 === l || "0px" !== m[2]) ? parseFloat(m[2]) : l) || 0, f.xs0 = f.e = m[0] + " " + (m[1] || "50%") + " 0px", f = new mb(q, "zOrigin", 0, 0, f, -1, f.n), f.b = l, f.xs0 = f.e = q.zOrigin) : f.xs0 = f.e = m) : bb(m + "", q)), o && (d._transformType = n || 3 === this._transformType ? 3 : 2), f
            }, prefix: !0
        }), qb("boxShadow", {
            defaultValue: "0px 0px 0px 0px #999",
            prefix: !0,
            color: !0,
            multi: !0,
            keyword: "inset"
        }), qb("borderRadius", {
            defaultValue: "0px", parser: function (a, b, c, f, g) {
                b = this.format(b);
                var h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x = ["borderTopLeftRadius", "borderTopRightRadius", "borderBottomRightRadius", "borderBottomLeftRadius"], y = a.style;
                for (p = parseFloat(a.offsetWidth), q = parseFloat(a.offsetHeight), h = b.split(" "), i = 0; i < x.length; i++)this.p.indexOf("border") && (x[i] = T(x[i])), l = k = V(a, x[i], e, !1, "0px"), -1 !== l.indexOf(" ") && (k = l.split(" "), l = k[0], k = k[1]), m = j = h[i], n = parseFloat(l), s = l.substr((n + "").length), t = "=" === m.charAt(1), t ? (o = parseInt(m.charAt(0) + "1", 10), m = m.substr(2), o *= parseFloat(m), r = m.substr((o + "").length - (0 > o ? 1 : 0)) || "") : (o = parseFloat(m), r = m.substr((o + "").length)), "" === r && (r = d[c] || s), r !== s && (u = W(a, "borderLeft", n, s), v = W(a, "borderTop", n, s), "%" === r ? (l = u / p * 100 + "%", k = v / q * 100 + "%") : "em" === r ? (w = W(a, "borderLeft", 1, "em"), l = u / w + "em", k = v / w + "em") : (l = u + "px", k = v + "px"), t && (m = parseFloat(l) + o + r, j = parseFloat(k) + o + r)), g = nb(y, x[i], l + " " + k, m + " " + j, !1, "0px", g);
                return g
            }, prefix: !0, formatter: jb("0px 0px 0px 0px", !1, !0)
        }), qb("backgroundPosition", {
            defaultValue: "0 0", parser: function (a, b, c, d, f, g) {
                var h, i, j, k, l, m, n = "background-position", p = e || U(a, null), q = this.format((p ? o ? p.getPropertyValue(n + "-x") + " " + p.getPropertyValue(n + "-y") : p.getPropertyValue(n) : a.currentStyle.backgroundPositionX + " " + a.currentStyle.backgroundPositionY) || "0 0"), r = this.format(b);
                if (-1 !== q.indexOf("%") != (-1 !== r.indexOf("%")) && (m = V(a, "backgroundImage").replace(A, ""), m && "none" !== m)) {
                    for (h = q.split(" "), i = r.split(" "), L.setAttribute("src", m), j = 2; --j > -1;)q = h[j], k = -1 !== q.indexOf("%"), k !== (-1 !== i[j].indexOf("%")) && (l = 0 === j ? a.offsetWidth - L.width : a.offsetHeight - L.height, h[j] = k ? parseFloat(q) / 100 * l + "px" : parseFloat(q) / l * 100 + "%");
                    q = h.join(" ")
                }
                return this.parseComplex(a.style, q, r, f, g)
            }, formatter: bb
        }), qb("backgroundSize", {defaultValue: "0 0", formatter: bb}), qb("perspective", {
            defaultValue: "0px",
            prefix: !0
        }), qb("perspectiveOrigin", {
            defaultValue: "50% 50%",
            prefix: !0
        }), qb("transformStyle", {prefix: !0}), qb("backfaceVisibility", {prefix: !0}), qb("userSelect", {prefix: !0}), qb("margin", {parser: kb("marginTop,marginRight,marginBottom,marginLeft")}), qb("padding", {parser: kb("paddingTop,paddingRight,paddingBottom,paddingLeft")}), qb("clip", {
            defaultValue: "rect(0px,0px,0px,0px)",
            parser: function (a, b, c, d, f, g) {
                var h, i, j;
                return 9 > o ? (i = a.currentStyle, j = 8 > o ? " " : ",", h = "rect(" + i.clipTop + j + i.clipRight + j + i.clipBottom + j + i.clipLeft + ")", b = this.format(b).split(",").join(j)) : (h = this.format(V(a, this.p, e, !1, this.dflt)), b = this.format(b)), this.parseComplex(a.style, h, b, f, g)
            }
        }), qb("textShadow", {
            defaultValue: "0px 0px 0px #999",
            color: !0,
            multi: !0
        }), qb("autoRound,strictUnits", {
            parser: function (a, b, c, d, e) {
                return e
            }
        }), qb("border", {
            defaultValue: "0px solid #000", parser: function (a, b, c, d, f, g) {
                return this.parseComplex(a.style, this.format(V(a, "borderTopWidth", e, !1, "0px") + " " + V(a, "borderTopStyle", e, !1, "solid") + " " + V(a, "borderTopColor", e, !1, "#000")), this.format(b), f, g)
            }, color: !0, formatter: function (a) {
                var b = a.split(" ");
                return b[0] + " " + (b[1] || "solid") + " " + (a.match(ib) || ["#000"])[0]
            }
        }), qb("borderWidth", {parser: kb("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}), qb("float,cssFloat,styleFloat", {
            parser: function (a, b, c, d, e) {
                var f = a.style, g = "cssFloat" in f ? "cssFloat" : "styleFloat";
                return new mb(f, g, 0, 0, e, -1, c, !1, 0, f[g], b)
            }
        });
        var Cb = function (a) {
            var b, c = this.t, d = c.filter || V(this.data, "filter"), e = this.s + this.c * a | 0;
            100 === e && (-1 === d.indexOf("atrix(") && -1 === d.indexOf("radient(") && -1 === d.indexOf("oader(") ? (c.removeAttribute("filter"), b = !V(this.data, "filter")) : (c.filter = d.replace(w, ""), b = !0)), b || (this.xn1 && (c.filter = d = d || "alpha(opacity=" + e + ")"), -1 === d.indexOf("pacity") ? 0 === e && this.xn1 || (c.filter = d + " alpha(opacity=" + e + ")") : c.filter = d.replace(u, "opacity=" + e))
        };
        qb("opacity,alpha,autoAlpha", {
            defaultValue: "1", parser: function (a, b, c, d, f, g) {
                var h = parseFloat(V(a, "opacity", e, !1, "1")), i = a.style, j = "autoAlpha" === c;
                return "string" == typeof b && "=" === b.charAt(1) && (b = ("-" === b.charAt(0) ? -1 : 1) * parseFloat(b.substr(2)) + h), j && 1 === h && "hidden" === V(a, "visibility", e) && 0 !== b && (h = 0), O ? f = new mb(i, "opacity", h, b - h, f) : (f = new mb(i, "opacity", 100 * h, 100 * (b - h), f), f.xn1 = j ? 1 : 0, i.zoom = 1, f.type = 2, f.b = "alpha(opacity=" + f.s + ")", f.e = "alpha(opacity=" + (f.s + f.c) + ")", f.data = a, f.plugin = g, f.setRatio = Cb), j && (f = new mb(i, "visibility", 0, 0, f, -1, null, !1, 0, 0 !== h ? "inherit" : "hidden", 0 === b ? "hidden" : "inherit"), f.xs0 = "inherit", d._overwriteProps.push(f.n), d._overwriteProps.push(c)), f
            }
        });
        var Db = function (a, b) {
            b && (a.removeProperty ? ("ms" === b.substr(0, 2) && (b = "M" + b.substr(1)), a.removeProperty(b.replace(y, "-$1").toLowerCase())) : a.removeAttribute(b))
        }, Eb = function (a) {
            if (this.t._gsClassPT = this, 1 === a || 0 === a) {
                this.t.setAttribute("class", 0 === a ? this.b : this.e);
                for (var b = this.data, c = this.t.style; b;)b.v ? c[b.p] = b.v : Db(c, b.p), b = b._next;
                1 === a && this.t._gsClassPT === this && (this.t._gsClassPT = null)
            } else this.t.getAttribute("class") !== this.e && this.t.setAttribute("class", this.e)
        };
        qb("className", {
            parser: function (a, b, d, f, g, h, i) {
                var j, k, l, m, n, o = a.getAttribute("class") || "", p = a.style.cssText;
                if (g = f._classNamePT = new mb(a, d, 0, 0, g, 2), g.setRatio = Eb, g.pr = -11, c = !0, g.b = o, k = Y(a, e), l = a._gsClassPT) {
                    for (m = {}, n = l.data; n;)m[n.p] = 1, n = n._next;
                    l.setRatio(1)
                }
                return a._gsClassPT = g, g.e = "=" !== b.charAt(1) ? b : o.replace(new RegExp("\\s*\\b" + b.substr(2) + "\\b"), "") + ("+" === b.charAt(0) ? " " + b.substr(2) : ""), f._tween._duration && (a.setAttribute("class", g.e), j = Z(a, k, Y(a), i, m), a.setAttribute("class", o), g.data = j.firstMPT, a.style.cssText = p, g = g.xfirst = f.parse(a, j.difs, g, h)), g
            }
        });
        var Fb = function (a) {
            if ((1 === a || 0 === a) && this.data._totalTime === this.data._totalDuration && "isFromStart" !== this.data.data) {
                var b, c, d, e, f = this.t.style, g = h.transform.parse;
                if ("all" === this.e)f.cssText = "", e = !0; else for (b = this.e.split(","), d = b.length; --d > -1;)c = b[d], h[c] && (h[c].parse === g ? e = !0 : c = "transformOrigin" === c ? vb : h[c].p), Db(f, c);
                e && (Db(f, tb), this.t._gsTransform && delete this.t._gsTransform)
            }
        };
        for (qb("clearProps", {
            parser: function (a, b, d, e, f) {
                return f = new mb(a, d, 0, 0, f, 2), f.setRatio = Fb, f.e = b, f.pr = -10, f.data = e._tween, c = !0, f
            }
        }), i = "bezier,throwProps,physicsProps,physics2D".split(","), ob = i.length; ob--;)rb(i[ob]);
        i = g.prototype, i._firstPT = null, i._onInitTween = function (a, b, h) {
            if (!a.nodeType)return !1;
            this._target = a, this._tween = h, this._vars = b, j = b.autoRound, c = !1, d = b.suffixMap || g.suffixMap, e = U(a, ""), f = this._overwriteProps;
            var i, m, o, p, q, r, s, t, u, w = a.style;
            if (k && "" === w.zIndex && (i = V(a, "zIndex", e), ("auto" === i || "" === i) && this._addLazySet(w, "zIndex", 0)), "string" == typeof b && (p = w.cssText, i = Y(a, e), w.cssText = p + ";" + b, i = Z(a, i, Y(a)).difs, !O && v.test(b) && (i.opacity = parseFloat(RegExp.$1)), b = i, w.cssText = p), this._firstPT = m = this.parse(a, b, null), this._transformType) {
                for (u = 3 === this._transformType, tb ? l && (k = !0, "" === w.zIndex && (s = V(a, "zIndex", e), ("auto" === s || "" === s) && this._addLazySet(w, "zIndex", 0)), n && this._addLazySet(w, "WebkitBackfaceVisibility", this._vars.WebkitBackfaceVisibility || (u ? "visible" : "hidden"))) : w.zoom = 1, o = m; o && o._next;)o = o._next;
                t = new mb(a, "transform", 0, 0, null, 2), this._linkCSSP(t, null, o), t.setRatio = u && wb ? Ab : tb ? Bb : zb, t.data = this._transform || yb(a, e, !0), f.pop()
            }
            if (c) {
                for (; m;) {
                    for (r = m._next, o = p; o && o.pr > m.pr;)o = o._next;
                    (m._prev = o ? o._prev : q) ? m._prev._next = m : p = m, (m._next = o) ? o._prev = m : q = m, m = r
                }
                this._firstPT = p
            }
            return !0
        }, i.parse = function (a, b, c, f) {
            var g, i, k, l, m, n, o, p, q, r, s = a.style;
            for (g in b)n = b[g], i = h[g], i ? c = i.parse(a, n, g, this, c, f, b) : (m = V(a, g, e) + "", q = "string" == typeof n, "color" === g || "fill" === g || "stroke" === g || -1 !== g.indexOf("Color") || q && x.test(n) ? (q || (n = hb(n), n = (n.length > 3 ? "rgba(" : "rgb(") + n.join(",") + ")"), c = nb(s, g, m, n, !0, "transparent", c, 0, f)) : !q || -1 === n.indexOf(" ") && -1 === n.indexOf(",") ? (k = parseFloat(m), o = k || 0 === k ? m.substr((k + "").length) : "", ("" === m || "auto" === m) && ("width" === g || "height" === g ? (k = ab(a, g, e), o = "px") : "left" === g || "top" === g ? (k = X(a, g, e), o = "px") : (k = "opacity" !== g ? 0 : 1, o = "")), r = q && "=" === n.charAt(1), r ? (l = parseInt(n.charAt(0) + "1", 10), n = n.substr(2), l *= parseFloat(n), p = n.replace(t, "")) : (l = parseFloat(n), p = q ? n.substr((l + "").length) || "" : ""), "" === p && (p = g in d ? d[g] : o), n = l || 0 === l ? (r ? l + k : l) + p : b[g], o !== p && "" !== p && (l || 0 === l) && k && (k = W(a, g, k, o), "%" === p ? (k /= W(a, g, 100, "%") / 100, b.strictUnits !== !0 && (m = k + "%")) : "em" === p ? k /= W(a, g, 1, "em") : "px" !== p && (l = W(a, g, l, p), p = "px"), r && (l || 0 === l) && (n = l + k + p)), r && (l += k), !k && 0 !== k || !l && 0 !== l ? void 0 !== s[g] && (n || n + "" != "NaN" && null != n) ? (c = new mb(s, g, l || k || 0, 0, c, -1, g, !1, 0, m, n), c.xs0 = "none" !== n || "display" !== g && -1 === g.indexOf("Style") ? n : m) : Q("invalid " + g + " tween value: " + b[g]) : (c = new mb(s, g, k, l - k, c, 0, g, j !== !1 && ("px" === p || "zIndex" === g), 0, m, n), c.xs0 = p)) : c = nb(s, g, m, n, !0, null, c, 0, f)), f && c && !c.plugin && (c.plugin = f);
            return c
        }, i.setRatio = function (a) {
            var b, c, d, e = this._firstPT, f = 1e-6;
            if (1 !== a || this._tween._time !== this._tween._duration && 0 !== this._tween._time)if (a || this._tween._time !== this._tween._duration && 0 !== this._tween._time || this._tween._rawPrevTime === -1e-6)for (; e;) {
                if (b = e.c * a + e.s, e.r ? b = Math.round(b) : f > b && b > -f && (b = 0), e.type)if (1 === e.type)if (d = e.l, 2 === d)e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2; else if (3 === d)e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3; else if (4 === d)e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4; else if (5 === d)e.t[e.p] = e.xs0 + b + e.xs1 + e.xn1 + e.xs2 + e.xn2 + e.xs3 + e.xn3 + e.xs4 + e.xn4 + e.xs5; else {
                    for (c = e.xs0 + b + e.xs1, d = 1; d < e.l; d++)c += e["xn" + d] + e["xs" + (d + 1)];
                    e.t[e.p] = c
                } else-1 === e.type ? e.t[e.p] = e.xs0 : e.setRatio && e.setRatio(a); else e.t[e.p] = b + e.xs0;
                e = e._next
            } else for (; e;)2 !== e.type ? e.t[e.p] = e.b : e.setRatio(a), e = e._next; else for (; e;)2 !== e.type ? e.t[e.p] = e.e : e.setRatio(a), e = e._next
        }, i._enableTransforms = function (a) {
            this._transformType = a || 3 === this._transformType ? 3 : 2, this._transform = this._transform || yb(this._target, e, !0)
        };
        var Gb = function () {
            this.t[this.p] = this.e, this.data._linkCSSP(this, this._next, null, !0)
        };
        i._addLazySet = function (a, b, c) {
            var d = this._firstPT = new mb(a, b, 0, 0, this._firstPT, 2);
            d.e = c, d.setRatio = Gb, d.data = this
        }, i._linkCSSP = function (a, b, c, d) {
            return a && (b && (b._prev = a), a._next && (a._next._prev = a._prev), a._prev ? a._prev._next = a._next : this._firstPT === a && (this._firstPT = a._next, d = !0), c ? c._next = a : d || null !== this._firstPT || (this._firstPT = a), a._next = b, a._prev = c), a
        }, i._kill = function (b) {
            var c, d, e, f = b;
            if (b.autoAlpha || b.alpha) {
                f = {};
                for (d in b)f[d] = b[d];
                f.opacity = 1, f.autoAlpha && (f.visibility = 1)
            }
            return b.className && (c = this._classNamePT) && (e = c.xfirst, e && e._prev ? this._linkCSSP(e._prev, c._next, e._prev._prev) : e === this._firstPT && (this._firstPT = c._next), c._next && this._linkCSSP(c._next, c._next._next, e._prev), this._classNamePT = null), a.prototype._kill.call(this, f)
        };
        var Hb = function (a, b, c) {
            var d, e, f, g;
            if (a.slice)for (e = a.length; --e > -1;)Hb(a[e], b, c); else for (d = a.childNodes, e = d.length; --e > -1;)f = d[e], g = f.type, f.style && (b.push(Y(f)), c && c.push(f)), 1 !== g && 9 !== g && 11 !== g || !f.childNodes.length || Hb(f, b, c)
        };
        return g.cascadeTo = function (a, c, d) {
            var e, f, g, h = b.to(a, c, d), i = [h], j = [], k = [], l = [], m = b._internals.reservedProps;
            for (a = h._targets || h.target, Hb(a, j, l), h.render(c, !0), Hb(a, k), h.render(0, !0), h._enabled(!0), e = l.length; --e > -1;)if (f = Z(l[e], j[e], k[e]), f.firstMPT) {
                f = f.difs;
                for (g in d)m[g] && (f[g] = d[g]);
                i.push(b.to(l[e], c, f))
            }
            return i
        }, a.activate([g]), g
    }, !0), function () {
        var a = _gsScope._gsDefine.plugin({
            propName: "roundProps", priority: -1, API: 2, init: function (a, b, c) {
                return this._tween = c, !0
            }
        }), b = a.prototype;
        b._onInitAllProps = function () {
            for (var a, b, c, d = this._tween, e = d.vars.roundProps instanceof Array ? d.vars.roundProps : d.vars.roundProps.split(","), f = e.length, g = {}, h = d._propLookup.roundProps; --f > -1;)g[e[f]] = 1;
            for (f = e.length; --f > -1;)for (a = e[f], b = d._firstPT; b;)c = b._next, b.pg ? b.t._roundProps(g, !0) : b.n === a && (this._add(b.t, a, b.s, b.c), c && (c._prev = b._prev), b._prev ? b._prev._next = c : d._firstPT === b && (d._firstPT = c), b._next = b._prev = null, d._propLookup[a] = h), b = c;
            return !1
        }, b._add = function (a, b, c, d) {
            this._addTween(a, b, c, c + d, b, !0), this._overwriteProps.push(b)
        }
    }(), _gsScope._gsDefine.plugin({
        propName: "attr", API: 2, version: "0.3.3", init: function (a, b) {
            var c, d, e;
            if ("function" != typeof a.setAttribute)return !1;
            this._target = a, this._proxy = {}, this._start = {}, this._end = {};
            for (c in b)this._start[c] = this._proxy[c] = d = a.getAttribute(c), e = this._addTween(this._proxy, c, parseFloat(d), b[c], c), this._end[c] = e ? e.s + e.c : b[c], this._overwriteProps.push(c);
            return !0
        }, set: function (a) {
            this._super.setRatio.call(this, a);
            for (var b, c = this._overwriteProps, d = c.length, e = 1 === a ? this._end : a ? this._proxy : this._start; --d > -1;)b = c[d], this._target.setAttribute(b, e[b] + "")
        }
    }), _gsScope._gsDefine.plugin({
        propName: "directionalRotation", version: "0.2.1", API: 2, init: function (a, b) {
            "object" != typeof b && (b = {rotation: b}), this.finals = {};
            var c, d, e, f, g, h, i = b.useRadians === !0 ? 2 * Math.PI : 360, j = 1e-6;
            for (c in b)"useRadians" !== c && (h = (b[c] + "").split("_"), d = h[0], e = parseFloat("function" != typeof a[c] ? a[c] : a[c.indexOf("set") || "function" != typeof a["get" + c.substr(3)] ? c : "get" + c.substr(3)]()), f = this.finals[c] = "string" == typeof d && "=" === d.charAt(1) ? e + parseInt(d.charAt(0) + "1", 10) * Number(d.substr(2)) : Number(d) || 0, g = f - e, h.length && (d = h.join("_"), -1 !== d.indexOf("short") && (g %= i, g !== g % (i / 2) && (g = 0 > g ? g + i : g - i)), -1 !== d.indexOf("_cw") && 0 > g ? g = (g + 9999999999 * i) % i - (g / i | 0) * i : -1 !== d.indexOf("ccw") && g > 0 && (g = (g - 9999999999 * i) % i - (g / i | 0) * i)), (g > j || -j > g) && (this._addTween(a, c, e, e + g, c), this._overwriteProps.push(c)));
            return !0
        }, set: function (a) {
            var b;
            if (1 !== a)this._super.setRatio.call(this, a); else for (b = this._firstPT; b;)b.f ? b.t[b.p](this.finals[b.p]) : b.t[b.p] = this.finals[b.p], b = b._next
        }
    })._autoCSS = !0, _gsScope._gsDefine("easing.Back", ["easing.Ease"], function (a) {
        var b, c, d, e = _gsScope.GreenSockGlobals || _gsScope, f = e.com.greensock, g = 2 * Math.PI, h = Math.PI / 2, i = f._class, j = function (b, c) {
            var d = i("easing." + b, function () {
            }, !0), e = d.prototype = new a;
            return e.constructor = d, e.getRatio = c, d
        }, k = a.register || function () {
            }, l = function (a, b, c, d) {
            var e = i("easing." + a, {easeOut: new b, easeIn: new c, easeInOut: new d}, !0);
            return k(e, a), e
        }, m = function (a, b, c) {
            this.t = a, this.v = b, c && (this.next = c, c.prev = this, this.c = c.v - b, this.gap = c.t - a)
        }, n = function (b, c) {
            var d = i("easing." + b, function (a) {
                this._p1 = a || 0 === a ? a : 1.70158, this._p2 = 1.525 * this._p1
            }, !0), e = d.prototype = new a;
            return e.constructor = d, e.getRatio = c, e.config = function (a) {
                return new d(a)
            }, d
        }, o = l("Back", n("BackOut", function (a) {
            return (a -= 1) * a * ((this._p1 + 1) * a + this._p1) + 1
        }), n("BackIn", function (a) {
            return a * a * ((this._p1 + 1) * a - this._p1)
        }), n("BackInOut", function (a) {
            return (a *= 2) < 1 ? .5 * a * a * ((this._p2 + 1) * a - this._p2) : .5 * ((a -= 2) * a * ((this._p2 + 1) * a + this._p2) + 2)
        })), p = i("easing.SlowMo", function (a, b, c) {
            b = b || 0 === b ? b : .7, null == a ? a = .7 : a > 1 && (a = 1), this._p = 1 !== a ? b : 0, this._p1 = (1 - a) / 2, this._p2 = a, this._p3 = this._p1 + this._p2, this._calcEnd = c === !0
        }, !0), q = p.prototype = new a;
        return q.constructor = p, q.getRatio = function (a) {
            var b = a + (.5 - a) * this._p;
            return a < this._p1 ? this._calcEnd ? 1 - (a = 1 - a / this._p1) * a : b - (a = 1 - a / this._p1) * a * a * a * b : a > this._p3 ? this._calcEnd ? 1 - (a = (a - this._p3) / this._p1) * a : b + (a - b) * (a = (a - this._p3) / this._p1) * a * a * a : this._calcEnd ? 1 : b
        }, p.ease = new p(.7, .7), q.config = p.config = function (a, b, c) {
            return new p(a, b, c)
        }, b = i("easing.SteppedEase", function (a) {
            a = a || 1, this._p1 = 1 / a, this._p2 = a + 1
        }, !0), q = b.prototype = new a, q.constructor = b, q.getRatio = function (a) {
            return 0 > a ? a = 0 : a >= 1 && (a = .999999999), (this._p2 * a >> 0) * this._p1
        }, q.config = b.config = function (a) {
            return new b(a)
        }, c = i("easing.RoughEase", function (b) {
            b = b || {};
            for (var c, d, e, f, g, h, i = b.taper || "none", j = [], k = 0, l = 0 | (b.points || 20), n = l, o = b.randomize !== !1, p = b.clamp === !0, q = b.template instanceof a ? b.template : null, r = "number" == typeof b.strength ? .4 * b.strength : .4; --n > -1;)c = o ? Math.random() : 1 / l * n, d = q ? q.getRatio(c) : c, "none" === i ? e = r : "out" === i ? (f = 1 - c, e = f * f * r) : "in" === i ? e = c * c * r : .5 > c ? (f = 2 * c, e = f * f * .5 * r) : (f = 2 * (1 - c), e = f * f * .5 * r), o ? d += Math.random() * e - .5 * e : n % 2 ? d += .5 * e : d -= .5 * e, p && (d > 1 ? d = 1 : 0 > d && (d = 0)), j[k++] = {
                x: c,
                y: d
            };
            for (j.sort(function (a, b) {
                return a.x - b.x
            }), h = new m(1, 1, null), n = l; --n > -1;)g = j[n], h = new m(g.x, g.y, h);
            this._prev = new m(0, 0, 0 !== h.t ? h : h.next)
        }, !0), q = c.prototype = new a, q.constructor = c, q.getRatio = function (a) {
            var b = this._prev;
            if (a > b.t) {
                for (; b.next && a >= b.t;)b = b.next;
                b = b.prev
            } else for (; b.prev && a <= b.t;)b = b.prev;
            return this._prev = b, b.v + (a - b.t) / b.gap * b.c
        }, q.config = function (a) {
            return new c(a)
        }, c.ease = new c, l("Bounce", j("BounceOut", function (a) {
            return 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375
        }), j("BounceIn", function (a) {
            return (a = 1 - a) < 1 / 2.75 ? 1 - 7.5625 * a * a : 2 / 2.75 > a ? 1 - (7.5625 * (a -= 1.5 / 2.75) * a + .75) : 2.5 / 2.75 > a ? 1 - (7.5625 * (a -= 2.25 / 2.75) * a + .9375) : 1 - (7.5625 * (a -= 2.625 / 2.75) * a + .984375)
        }), j("BounceInOut", function (a) {
            var b = .5 > a;
            return a = b ? 1 - 2 * a : 2 * a - 1, a = 1 / 2.75 > a ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375, b ? .5 * (1 - a) : .5 * a + .5
        })), l("Circ", j("CircOut", function (a) {
            return Math.sqrt(1 - (a -= 1) * a)
        }), j("CircIn", function (a) {
            return -(Math.sqrt(1 - a * a) - 1)
        }), j("CircInOut", function (a) {
            return (a *= 2) < 1 ? -.5 * (Math.sqrt(1 - a * a) - 1) : .5 * (Math.sqrt(1 - (a -= 2) * a) + 1)
        })), d = function (b, c, d) {
            var e = i("easing." + b, function (a, b) {
                this._p1 = a || 1, this._p2 = b || d, this._p3 = this._p2 / g * (Math.asin(1 / this._p1) || 0)
            }, !0), f = e.prototype = new a;
            return f.constructor = e, f.getRatio = c, f.config = function (a, b) {
                return new e(a, b)
            }, e
        }, l("Elastic", d("ElasticOut", function (a) {
            return this._p1 * Math.pow(2, -10 * a) * Math.sin((a - this._p3) * g / this._p2) + 1
        }, .3), d("ElasticIn", function (a) {
            return -(this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * g / this._p2))
        }, .3), d("ElasticInOut", function (a) {
            return (a *= 2) < 1 ? -.5 * this._p1 * Math.pow(2, 10 * (a -= 1)) * Math.sin((a - this._p3) * g / this._p2) : this._p1 * Math.pow(2, -10 * (a -= 1)) * Math.sin((a - this._p3) * g / this._p2) * .5 + 1
        }, .45)), l("Expo", j("ExpoOut", function (a) {
            return 1 - Math.pow(2, -10 * a)
        }), j("ExpoIn", function (a) {
            return Math.pow(2, 10 * (a - 1)) - .001
        }), j("ExpoInOut", function (a) {
            return (a *= 2) < 1 ? .5 * Math.pow(2, 10 * (a - 1)) : .5 * (2 - Math.pow(2, -10 * (a - 1)))
        })), l("Sine", j("SineOut", function (a) {
            return Math.sin(a * h)
        }), j("SineIn", function (a) {
            return -Math.cos(a * h) + 1
        }), j("SineInOut", function (a) {
            return -.5 * (Math.cos(Math.PI * a) - 1)
        })), i("easing.EaseLookup", {
            find: function (b) {
                return a.map[b]
            }
        }, !0), k(e.SlowMo, "SlowMo", "ease,"), k(c, "RoughEase", "ease,"), k(b, "SteppedEase", "ease,"), o
    }, !0)
}), _gsScope._gsDefine && _gsScope._gsQueue.pop()(), function (a, b) {
    "use strict";
    var c = a.GreenSockGlobals = a.GreenSockGlobals || a;
    if (!c.TweenLite) {
        var d, e, f, g, h, i = function (a) {
            var b, d = a.split("."), e = c;
            for (b = 0; b < d.length; b++)e[d[b]] = e = e[d[b]] || {};
            return e
        }, j = i("com.greensock"), k = 1e-10, l = function (a) {
            var b, c = [], d = a.length;
            for (b = 0; b !== d; c.push(a[b++]));
            return c
        }, m = function () {
        }, n = function () {
            var a = Object.prototype.toString, b = a.call([]);
            return function (c) {
                return null != c && (c instanceof Array || "object" == typeof c && !!c.push && a.call(c) === b)
            }
        }(), o = {}, p = function (d, e, f, g) {
            this.sc = o[d] ? o[d].sc : [], o[d] = this, this.gsClass = null, this.func = f;
            var h = [];
            this.check = function (j) {
                for (var k, l, m, n, q = e.length, r = q; --q > -1;)(k = o[e[q]] || new p(e[q], [])).gsClass ? (h[q] = k.gsClass, r--) : j && k.sc.push(this);
                if (0 === r && f)for (l = ("com.greensock." + d).split("."), m = l.pop(), n = i(l.join("."))[m] = this.gsClass = f.apply(f, h), g && (c[m] = n, "function" == typeof define && define.amd ? define((a.GreenSockAMDPath ? a.GreenSockAMDPath + "/" : "") + d.split(".").pop(), [], function () {
                    return n
                }) : d === b && "undefined" != typeof module && module.exports && (module.exports = n)), q = 0; q < this.sc.length; q++)this.sc[q].check()
            }, this.check(!0)
        }, q = a._gsDefine = function (a, b, c, d) {
            return new p(a, b, c, d)
        }, r = j._class = function (a, b, c) {
            return b = b || function () {
                }, q(a, [], function () {
                return b
            }, c), b
        };
        q.globals = c;
        var s = [0, 0, 1, 1], t = [], u = r("easing.Ease", function (a, b, c, d) {
            this._func = a, this._type = c || 0, this._power = d || 0, this._params = b ? s.concat(b) : s
        }, !0), v = u.map = {}, w = u.register = function (a, b, c, d) {
            for (var e, f, g, h, i = b.split(","), k = i.length, l = (c || "easeIn,easeOut,easeInOut").split(","); --k > -1;)for (f = i[k], e = d ? r("easing." + f, null, !0) : j.easing[f] || {}, g = l.length; --g > -1;)h = l[g], v[f + "." + h] = v[h + f] = e[h] = a.getRatio ? a : a[h] || new a
        };
        for (f = u.prototype, f._calcEnd = !1, f.getRatio = function (a) {
            if (this._func)return this._params[0] = a, this._func.apply(null, this._params);
            var b = this._type, c = this._power, d = 1 === b ? 1 - a : 2 === b ? a : .5 > a ? 2 * a : 2 * (1 - a);
            return 1 === c ? d *= d : 2 === c ? d *= d * d : 3 === c ? d *= d * d * d : 4 === c && (d *= d * d * d * d), 1 === b ? 1 - d : 2 === b ? d : .5 > a ? d / 2 : 1 - d / 2
        }, d = ["Linear", "Quad", "Cubic", "Quart", "Quint,Strong"], e = d.length; --e > -1;)f = d[e] + ",Power" + e, w(new u(null, null, 1, e), f, "easeOut", !0), w(new u(null, null, 2, e), f, "easeIn" + (0 === e ? ",easeNone" : "")), w(new u(null, null, 3, e), f, "easeInOut");
        v.linear = j.easing.Linear.easeIn, v.swing = j.easing.Quad.easeInOut;
        var x = r("events.EventDispatcher", function (a) {
            this._listeners = {}, this._eventTarget = a || this
        });
        f = x.prototype, f.addEventListener = function (a, b, c, d, e) {
            e = e || 0;
            var f, i, j = this._listeners[a], k = 0;
            for (null == j && (this._listeners[a] = j = []), i = j.length; --i > -1;)f = j[i], f.c === b && f.s === c ? j.splice(i, 1) : 0 === k && f.pr < e && (k = i + 1);
            j.splice(k, 0, {c: b, s: c, up: d, pr: e}), this !== g || h || g.wake()
        }, f.removeEventListener = function (a, b) {
            var c, d = this._listeners[a];
            if (d)for (c = d.length; --c > -1;)if (d[c].c === b)return void d.splice(c, 1)
        }, f.dispatchEvent = function (a) {
            var b, c, d, e = this._listeners[a];
            if (e)for (b = e.length, c = this._eventTarget; --b > -1;)d = e[b], d.up ? d.c.call(d.s || c, {
                type: a,
                target: c
            }) : d.c.call(d.s || c)
        };
        var y = a.requestAnimationFrame, z = a.cancelAnimationFrame, A = Date.now || function () {
                return (new Date).getTime()
            }, B = A();
        for (d = ["ms", "moz", "webkit", "o"], e = d.length; --e > -1 && !y;)y = a[d[e] + "RequestAnimationFrame"], z = a[d[e] + "CancelAnimationFrame"] || a[d[e] + "CancelRequestAnimationFrame"];
        r("Ticker", function (a, b) {
            var c, d, e, f, i, j = this, l = A(), n = b !== !1 && y, o = 500, p = 33, q = function (a) {
                var b, g, h = A() - B;
                h > o && (l += h - p), B += h, j.time = (B - l) / 1e3, b = j.time - i, (!c || b > 0 || a === !0) && (j.frame++, i += b + (b >= f ? .004 : f - b), g = !0), a !== !0 && (e = d(q)), g && j.dispatchEvent("tick")
            };
            x.call(j), j.time = j.frame = 0, j.tick = function () {
                q(!0)
            }, j.lagSmoothing = function (a, b) {
                o = a || 1 / k, p = Math.min(b, o, 0)
            }, j.sleep = function () {
                null != e && (n && z ? z(e) : clearTimeout(e), d = m, e = null, j === g && (h = !1))
            }, j.wake = function () {
                null !== e ? j.sleep() : j.frame > 10 && (B = A() - o + 5), d = 0 === c ? m : n && y ? y : function (a) {
                    return setTimeout(a, 1e3 * (i - j.time) + 1 | 0)
                }, j === g && (h = !0), q(2)
            }, j.fps = function (a) {
                return arguments.length ? (c = a, f = 1 / (c || 60), i = this.time + f, void j.wake()) : c
            }, j.useRAF = function (a) {
                return arguments.length ? (j.sleep(), n = a, void j.fps(c)) : n
            }, j.fps(a), setTimeout(function () {
                n && (!e || j.frame < 5) && j.useRAF(!1)
            }, 1500)
        }), f = j.Ticker.prototype = new j.events.EventDispatcher, f.constructor = j.Ticker;
        var C = r("core.Animation", function (a, b) {
            if (this.vars = b = b || {}, this._duration = this._totalDuration = a || 0, this._delay = Number(b.delay) || 0, this._timeScale = 1, this._active = b.immediateRender === !0, this.data = b.data, this._reversed = b.reversed === !0, R) {
                h || g.wake();
                var c = this.vars.useFrames ? Q : R;
                c.add(this, c._time), this.vars.paused && this.paused(!0)
            }
        });
        g = C.ticker = new j.Ticker, f = C.prototype, f._dirty = f._gc = f._initted = f._paused = !1, f._totalTime = f._time = 0, f._rawPrevTime = -1, f._next = f._last = f._onUpdate = f._timeline = f.timeline = null, f._paused = !1;
        var D = function () {
            h && A() - B > 2e3 && g.wake(), setTimeout(D, 2e3)
        };
        D(), f.play = function (a, b) {
            return null != a && this.seek(a, b), this.reversed(!1).paused(!1)
        }, f.pause = function (a, b) {
            return null != a && this.seek(a, b), this.paused(!0)
        }, f.resume = function (a, b) {
            return null != a && this.seek(a, b), this.paused(!1)
        }, f.seek = function (a, b) {
            return this.totalTime(Number(a), b !== !1)
        }, f.restart = function (a, b) {
            return this.reversed(!1).paused(!1).totalTime(a ? -this._delay : 0, b !== !1, !0)
        }, f.reverse = function (a, b) {
            return null != a && this.seek(a || this.totalDuration(), b), this.reversed(!0).paused(!1)
        }, f.render = function () {
        }, f.invalidate = function () {
            return this._time = this._totalTime = 0, this._initted = this._gc = !1, this._rawPrevTime = -1, (this._gc || !this.timeline) && this._enabled(!0), this
        }, f.isActive = function () {
            var a, b = this._timeline, c = this._startTime;
            return !b || !this._gc && !this._paused && b.isActive() && (a = b.rawTime()) >= c && a < c + this.totalDuration() / this._timeScale
        }, f._enabled = function (a, b) {
            return h || g.wake(), this._gc = !a, this._active = this.isActive(), b !== !0 && (a && !this.timeline ? this._timeline.add(this, this._startTime - this._delay) : !a && this.timeline && this._timeline._remove(this, !0)), !1
        }, f._kill = function () {
            return this._enabled(!1, !1)
        }, f.kill = function (a, b) {
            return this._kill(a, b), this
        }, f._uncache = function (a) {
            for (var b = a ? this : this.timeline; b;)b._dirty = !0, b = b.timeline;
            return this
        }, f._swapSelfInParams = function (a) {
            for (var b = a.length, c = a.concat(); --b > -1;)"{self}" === a[b] && (c[b] = this);
            return c
        }, f.eventCallback = function (a, b, c, d) {
            if ("on" === (a || "").substr(0, 2)) {
                var e = this.vars;
                if (1 === arguments.length)return e[a];
                null == b ? delete e[a] : (e[a] = b, e[a + "Params"] = n(c) && -1 !== c.join("").indexOf("{self}") ? this._swapSelfInParams(c) : c, e[a + "Scope"] = d), "onUpdate" === a && (this._onUpdate = b)
            }
            return this
        }, f.delay = function (a) {
            return arguments.length ? (this._timeline.smoothChildTiming && this.startTime(this._startTime + a - this._delay), this._delay = a, this) : this._delay
        }, f.duration = function (a) {
            return arguments.length ? (this._duration = this._totalDuration = a, this._uncache(!0), this._timeline.smoothChildTiming && this._time > 0 && this._time < this._duration && 0 !== a && this.totalTime(this._totalTime * (a / this._duration), !0), this) : (this._dirty = !1, this._duration)
        }, f.totalDuration = function (a) {
            return this._dirty = !1, arguments.length ? this.duration(a) : this._totalDuration
        }, f.time = function (a, b) {
            return arguments.length ? (this._dirty && this.totalDuration(), this.totalTime(a > this._duration ? this._duration : a, b)) : this._time
        }, f.totalTime = function (a, b, c) {
            if (h || g.wake(), !arguments.length)return this._totalTime;
            if (this._timeline) {
                if (0 > a && !c && (a += this.totalDuration()), this._timeline.smoothChildTiming) {
                    this._dirty && this.totalDuration();
                    var d = this._totalDuration, e = this._timeline;
                    if (a > d && !c && (a = d), this._startTime = (this._paused ? this._pauseTime : e._time) - (this._reversed ? d - a : a) / this._timeScale, e._dirty || this._uncache(!1), e._timeline)for (; e._timeline;)e._timeline._time !== (e._startTime + e._totalTime) / e._timeScale && e.totalTime(e._totalTime, !0), e = e._timeline
                }
                this._gc && this._enabled(!0, !1), (this._totalTime !== a || 0 === this._duration) && (this.render(a, b, !1), I.length && S())
            }
            return this
        }, f.progress = f.totalProgress = function (a, b) {
            return arguments.length ? this.totalTime(this.duration() * a, b) : this._time / this.duration()
        }, f.startTime = function (a) {
            return arguments.length ? (a !== this._startTime && (this._startTime = a, this.timeline && this.timeline._sortChildren && this.timeline.add(this, a - this._delay)), this) : this._startTime
        }, f.timeScale = function (a) {
            if (!arguments.length)return this._timeScale;
            if (a = a || k, this._timeline && this._timeline.smoothChildTiming) {
                var b = this._pauseTime, c = b || 0 === b ? b : this._timeline.totalTime();
                this._startTime = c - (c - this._startTime) * this._timeScale / a
            }
            return this._timeScale = a, this._uncache(!1)
        }, f.reversed = function (a) {
            return arguments.length ? (a != this._reversed && (this._reversed = a, this.totalTime(this._timeline && !this._timeline.smoothChildTiming ? this.totalDuration() - this._totalTime : this._totalTime, !0)), this) : this._reversed
        }, f.paused = function (a) {
            if (!arguments.length)return this._paused;
            if (a != this._paused && this._timeline) {
                h || a || g.wake();
                var b = this._timeline, c = b.rawTime(), d = c - this._pauseTime;
                !a && b.smoothChildTiming && (this._startTime += d, this._uncache(!1)), this._pauseTime = a ? c : null, this._paused = a, this._active = this.isActive(), !a && 0 !== d && this._initted && this.duration() && this.render(b.smoothChildTiming ? this._totalTime : (c - this._startTime) / this._timeScale, !0, !0)
            }
            return this._gc && !a && this._enabled(!0, !1), this
        };
        var E = r("core.SimpleTimeline", function (a) {
            C.call(this, 0, a), this.autoRemoveChildren = this.smoothChildTiming = !0
        });
        f = E.prototype = new C, f.constructor = E, f.kill()._gc = !1, f._first = f._last = null, f._sortChildren = !1, f.add = f.insert = function (a, b) {
            var c, d;
            if (a._startTime = Number(b || 0) + a._delay, a._paused && this !== a._timeline && (a._pauseTime = a._startTime + (this.rawTime() - a._startTime) / a._timeScale), a.timeline && a.timeline._remove(a, !0), a.timeline = a._timeline = this, a._gc && a._enabled(!0, !0), c = this._last, this._sortChildren)for (d = a._startTime; c && c._startTime > d;)c = c._prev;
            return c ? (a._next = c._next, c._next = a) : (a._next = this._first, this._first = a), a._next ? a._next._prev = a : this._last = a, a._prev = c, this._timeline && this._uncache(!0), this
        }, f._remove = function (a, b) {
            return a.timeline === this && (b || a._enabled(!1, !0), a._prev ? a._prev._next = a._next : this._first === a && (this._first = a._next), a._next ? a._next._prev = a._prev : this._last === a && (this._last = a._prev), a._next = a._prev = a.timeline = null, this._timeline && this._uncache(!0)), this
        }, f.render = function (a, b, c) {
            var d, e = this._first;
            for (this._totalTime = this._time = this._rawPrevTime = a; e;)d = e._next, (e._active || a >= e._startTime && !e._paused) && (e._reversed ? e.render((e._dirty ? e.totalDuration() : e._totalDuration) - (a - e._startTime) * e._timeScale, b, c) : e.render((a - e._startTime) * e._timeScale, b, c)), e = d
        }, f.rawTime = function () {
            return h || g.wake(), this._totalTime
        };
        var F = r("TweenLite", function (b, c, d) {
            if (C.call(this, c, d), this.render = F.prototype.render, null == b)throw"Cannot tween a null target.";
            this.target = b = "string" != typeof b ? b : F.selector(b) || b;
            var e, f, g, h = b.jquery || b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType), i = this.vars.overwrite;
            if (this._overwrite = i = null == i ? P[F.defaultOverwrite] : "number" == typeof i ? i >> 0 : P[i], (h || b instanceof Array || b.push && n(b)) && "number" != typeof b[0])for (this._targets = g = l(b), this._propLookup = [], this._siblings = [], e = 0; e < g.length; e++)f = g[e], f ? "string" != typeof f ? f.length && f !== a && f[0] && (f[0] === a || f[0].nodeType && f[0].style && !f.nodeType) ? (g.splice(e--, 1), this._targets = g = g.concat(l(f))) : (this._siblings[e] = T(f, this, !1), 1 === i && this._siblings[e].length > 1 && U(f, this, null, 1, this._siblings[e])) : (f = g[e--] = F.selector(f), "string" == typeof f && g.splice(e + 1, 1)) : g.splice(e--, 1); else this._propLookup = {}, this._siblings = T(b, this, !1), 1 === i && this._siblings.length > 1 && U(b, this, null, 1, this._siblings);
            (this.vars.immediateRender || 0 === c && 0 === this._delay && this.vars.immediateRender !== !1) && (this._time = -k, this.render(-this._delay))
        }, !0), G = function (b) {
            return b.length && b !== a && b[0] && (b[0] === a || b[0].nodeType && b[0].style && !b.nodeType)
        }, H = function (a, b) {
            var c, d = {};
            for (c in a)O[c] || c in b && "transform" !== c && "x" !== c && "y" !== c && "width" !== c && "height" !== c && "className" !== c && "border" !== c || !(!L[c] || L[c] && L[c]._autoCSS) || (d[c] = a[c], delete a[c]);
            a.css = d
        };
        f = F.prototype = new C, f.constructor = F, f.kill()._gc = !1, f.ratio = 0, f._firstPT = f._targets = f._overwrittenProps = f._startAt = null, f._notifyPluginsOfEnabled = f._lazy = !1, F.version = "1.13.2", F.defaultEase = f._ease = new u(null, null, 1, 1), F.defaultOverwrite = "auto", F.ticker = g, F.autoSleep = !0, F.lagSmoothing = function (a, b) {
            g.lagSmoothing(a, b)
        }, F.selector = a.$ || a.jQuery || function (b) {
                var c = a.$ || a.jQuery;
                return c ? (F.selector = c, c(b)) : "undefined" == typeof document ? b : document.querySelectorAll ? document.querySelectorAll(b) : document.getElementById("#" === b.charAt(0) ? b.substr(1) : b)
            };
        var I = [], J = {}, K = F._internals = {
            isArray: n,
            isSelector: G,
            lazyTweens: I
        }, L = F._plugins = {}, M = K.tweenLookup = {}, N = 0, O = K.reservedProps = {
            ease: 1,
            delay: 1,
            overwrite: 1,
            onComplete: 1,
            onCompleteParams: 1,
            onCompleteScope: 1,
            useFrames: 1,
            runBackwards: 1,
            startAt: 1,
            onUpdate: 1,
            onUpdateParams: 1,
            onUpdateScope: 1,
            onStart: 1,
            onStartParams: 1,
            onStartScope: 1,
            onReverseComplete: 1,
            onReverseCompleteParams: 1,
            onReverseCompleteScope: 1,
            onRepeat: 1,
            onRepeatParams: 1,
            onRepeatScope: 1,
            easeParams: 1,
            yoyo: 1,
            immediateRender: 1,
            repeat: 1,
            repeatDelay: 1,
            data: 1,
            paused: 1,
            reversed: 1,
            autoCSS: 1,
            lazy: 1
        }, P = {
            none: 0,
            all: 1,
            auto: 2,
            concurrent: 3,
            allOnStart: 4,
            preexisting: 5,
            "true": 1,
            "false": 0
        }, Q = C._rootFramesTimeline = new E, R = C._rootTimeline = new E, S = K.lazyRender = function () {
            var a = I.length;
            for (J = {}; --a > -1;)d = I[a], d && d._lazy !== !1 && (d.render(d._lazy[0], d._lazy[1], !0), d._lazy = !1);
            I.length = 0
        };
        R._startTime = g.time, Q._startTime = g.frame, R._active = Q._active = !0, setTimeout(S, 1), C._updateRoot = F.render = function () {
            var a, b, c;
            if (I.length && S(), R.render((g.time - R._startTime) * R._timeScale, !1, !1), Q.render((g.frame - Q._startTime) * Q._timeScale, !1, !1), I.length && S(), !(g.frame % 120)) {
                for (c in M) {
                    for (b = M[c].tweens, a = b.length; --a > -1;)b[a]._gc && b.splice(a, 1);
                    0 === b.length && delete M[c]
                }
                if (c = R._first, (!c || c._paused) && F.autoSleep && !Q._first && 1 === g._listeners.tick.length) {
                    for (; c && c._paused;)c = c._next;
                    c || g.sleep()
                }
            }
        }, g.addEventListener("tick", C._updateRoot);
        var T = function (a, b, c) {
            var d, e, f = a._gsTweenID;
            if (M[f || (a._gsTweenID = f = "t" + N++)] || (M[f] = {
                    target: a,
                    tweens: []
                }), b && (d = M[f].tweens, d[e = d.length] = b, c))for (; --e > -1;)d[e] === b && d.splice(e, 1);
            return M[f].tweens
        }, U = function (a, b, c, d, e) {
            var f, g, h, i;
            if (1 === d || d >= 4) {
                for (i = e.length, f = 0; i > f; f++)if ((h = e[f]) !== b)h._gc || h._enabled(!1, !1) && (g = !0); else if (5 === d)break;
                return g
            }
            var j, l = b._startTime + k, m = [], n = 0, o = 0 === b._duration;
            for (f = e.length; --f > -1;)(h = e[f]) === b || h._gc || h._paused || (h._timeline !== b._timeline ? (j = j || V(b, 0, o), 0 === V(h, j, o) && (m[n++] = h)) : h._startTime <= l && h._startTime + h.totalDuration() / h._timeScale > l && ((o || !h._initted) && l - h._startTime <= 2e-10 || (m[n++] = h)));
            for (f = n; --f > -1;)h = m[f], 2 === d && h._kill(c, a) && (g = !0), (2 !== d || !h._firstPT && h._initted) && h._enabled(!1, !1) && (g = !0);
            return g
        }, V = function (a, b, c) {
            for (var d = a._timeline, e = d._timeScale, f = a._startTime; d._timeline;) {
                if (f += d._startTime, e *= d._timeScale, d._paused)return -100;
                d = d._timeline
            }
            return f /= e, f > b ? f - b : c && f === b || !a._initted && 2 * k > f - b ? k : (f += a.totalDuration() / a._timeScale / e) > b + k ? 0 : f - b - k
        };
        f._init = function () {
            var a, b, c, d, e, f = this.vars, g = this._overwrittenProps, h = this._duration, i = !!f.immediateRender, j = f.ease;
            if (f.startAt) {
                this._startAt && (this._startAt.render(-1, !0), this._startAt.kill()), e = {};
                for (d in f.startAt)e[d] = f.startAt[d];
                if (e.overwrite = !1, e.immediateRender = !0, e.lazy = i && f.lazy !== !1, e.startAt = e.delay = null, this._startAt = F.to(this.target, 0, e), i)if (this._time > 0)this._startAt = null; else if (0 !== h)return
            } else if (f.runBackwards && 0 !== h)if (this._startAt)this._startAt.render(-1, !0), this._startAt.kill(), this._startAt = null; else {
                0 !== this._time && (i = !1), c = {};
                for (d in f)O[d] && "autoCSS" !== d || (c[d] = f[d]);
                if (c.overwrite = 0, c.data = "isFromStart", c.lazy = i && f.lazy !== !1, c.immediateRender = i, this._startAt = F.to(this.target, 0, c), i) {
                    if (0 === this._time)return
                } else this._startAt._init(), this._startAt._enabled(!1), this.vars.immediateRender && (this._startAt = null)
            }
            if (this._ease = j = j ? j instanceof u ? j : "function" == typeof j ? new u(j, f.easeParams) : v[j] || F.defaultEase : F.defaultEase, f.easeParams instanceof Array && j.config && (this._ease = j.config.apply(j, f.easeParams)), this._easeType = this._ease._type, this._easePower = this._ease._power, this._firstPT = null, this._targets)for (a = this._targets.length; --a > -1;)this._initProps(this._targets[a], this._propLookup[a] = {}, this._siblings[a], g ? g[a] : null) && (b = !0); else b = this._initProps(this.target, this._propLookup, this._siblings, g);
            if (b && F._onPluginEvent("_onInitAllProps", this), g && (this._firstPT || "function" != typeof this.target && this._enabled(!1, !1)), f.runBackwards)for (c = this._firstPT; c;)c.s += c.c, c.c = -c.c, c = c._next;
            this._onUpdate = f.onUpdate, this._initted = !0
        }, f._initProps = function (b, c, d, e) {
            var f, g, h, i, j, k;
            if (null == b)return !1;
            J[b._gsTweenID] && S(), this.vars.css || b.style && b !== a && b.nodeType && L.css && this.vars.autoCSS !== !1 && H(this.vars, b);
            for (f in this.vars) {
                if (k = this.vars[f], O[f])k && (k instanceof Array || k.push && n(k)) && -1 !== k.join("").indexOf("{self}") && (this.vars[f] = k = this._swapSelfInParams(k, this)); else if (L[f] && (i = new L[f])._onInitTween(b, this.vars[f], this)) {
                    for (this._firstPT = j = {
                        _next: this._firstPT,
                        t: i,
                        p: "setRatio",
                        s: 0,
                        c: 1,
                        f: !0,
                        n: f,
                        pg: !0,
                        pr: i._priority
                    }, g = i._overwriteProps.length; --g > -1;)c[i._overwriteProps[g]] = this._firstPT;
                    (i._priority || i._onInitAllProps) && (h = !0), (i._onDisable || i._onEnable) && (this._notifyPluginsOfEnabled = !0)
                } else this._firstPT = c[f] = j = {
                    _next: this._firstPT,
                    t: b,
                    p: f,
                    f: "function" == typeof b[f],
                    n: f,
                    pg: !1,
                    pr: 0
                }, j.s = j.f ? b[f.indexOf("set") || "function" != typeof b["get" + f.substr(3)] ? f : "get" + f.substr(3)]() : parseFloat(b[f]), j.c = "string" == typeof k && "=" === k.charAt(1) ? parseInt(k.charAt(0) + "1", 10) * Number(k.substr(2)) : Number(k) - j.s || 0;
                j && j._next && (j._next._prev = j)
            }
            return e && this._kill(e, b) ? this._initProps(b, c, d, e) : this._overwrite > 1 && this._firstPT && d.length > 1 && U(b, this, c, this._overwrite, d) ? (this._kill(c, b), this._initProps(b, c, d, e)) : (this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration) && (J[b._gsTweenID] = !0), h)
        }, f.render = function (a, b, c) {
            var d, e, f, g, h = this._time, i = this._duration, j = this._rawPrevTime;
            if (a >= i)this._totalTime = this._time = i, this.ratio = this._ease._calcEnd ? this._ease.getRatio(1) : 1, this._reversed || (d = !0, e = "onComplete"), 0 === i && (this._initted || !this.vars.lazy || c) && (this._startTime === this._timeline._duration && (a = 0), (0 === a || 0 > j || j === k) && j !== a && (c = !0, j > k && (e = "onReverseComplete")), this._rawPrevTime = g = !b || a || j === a ? a : k); else if (1e-7 > a)this._totalTime = this._time = 0, this.ratio = this._ease._calcEnd ? this._ease.getRatio(0) : 0, (0 !== h || 0 === i && j > 0 && j !== k) && (e = "onReverseComplete", d = this._reversed), 0 > a && (this._active = !1, 0 === i && (this._initted || !this.vars.lazy || c) && (j >= 0 && (c = !0), this._rawPrevTime = g = !b || a || j === a ? a : k)), this._initted || (c = !0); else if (this._totalTime = this._time = a, this._easeType) {
                var l = a / i, m = this._easeType, n = this._easePower;
                (1 === m || 3 === m && l >= .5) && (l = 1 - l), 3 === m && (l *= 2), 1 === n ? l *= l : 2 === n ? l *= l * l : 3 === n ? l *= l * l * l : 4 === n && (l *= l * l * l * l), this.ratio = 1 === m ? 1 - l : 2 === m ? l : .5 > a / i ? l / 2 : 1 - l / 2
            } else this.ratio = this._ease.getRatio(a / i);
            if (this._time !== h || c) {
                if (!this._initted) {
                    if (this._init(), !this._initted || this._gc)return;
                    if (!c && this._firstPT && (this.vars.lazy !== !1 && this._duration || this.vars.lazy && !this._duration))return this._time = this._totalTime = h, this._rawPrevTime = j, I.push(this), void(this._lazy = [a, b]);
                    this._time && !d ? this.ratio = this._ease.getRatio(this._time / i) : d && this._ease._calcEnd && (this.ratio = this._ease.getRatio(0 === this._time ? 0 : 1))
                }
                for (this._lazy !== !1 && (this._lazy = !1), this._active || !this._paused && this._time !== h && a >= 0 && (this._active = !0), 0 === h && (this._startAt && (a >= 0 ? this._startAt.render(a, b, c) : e || (e = "_dummyGS")), this.vars.onStart && (0 !== this._time || 0 === i) && (b || this.vars.onStart.apply(this.vars.onStartScope || this, this.vars.onStartParams || t))), f = this._firstPT; f;)f.f ? f.t[f.p](f.c * this.ratio + f.s) : f.t[f.p] = f.c * this.ratio + f.s, f = f._next;
                this._onUpdate && (0 > a && this._startAt && this._startTime && this._startAt.render(a, b, c), b || (this._time !== h || d) && this._onUpdate.apply(this.vars.onUpdateScope || this, this.vars.onUpdateParams || t)), e && (!this._gc || c) && (0 > a && this._startAt && !this._onUpdate && this._startTime && this._startAt.render(a, b, c), d && (this._timeline.autoRemoveChildren && this._enabled(!1, !1), this._active = !1), !b && this.vars[e] && this.vars[e].apply(this.vars[e + "Scope"] || this, this.vars[e + "Params"] || t), 0 === i && this._rawPrevTime === k && g !== k && (this._rawPrevTime = 0))
            }
        }, f._kill = function (a, b) {
            if ("all" === a && (a = null), null == a && (null == b || b === this.target))return this._lazy = !1, this._enabled(!1, !1);
            b = "string" != typeof b ? b || this._targets || this.target : F.selector(b) || b;
            var c, d, e, f, g, h, i, j;
            if ((n(b) || G(b)) && "number" != typeof b[0])for (c = b.length; --c > -1;)this._kill(a, b[c]) && (h = !0); else {
                if (this._targets) {
                    for (c = this._targets.length; --c > -1;)if (b === this._targets[c]) {
                        g = this._propLookup[c] || {}, this._overwrittenProps = this._overwrittenProps || [], d = this._overwrittenProps[c] = a ? this._overwrittenProps[c] || {} : "all";
                        break
                    }
                } else {
                    if (b !== this.target)return !1;
                    g = this._propLookup, d = this._overwrittenProps = a ? this._overwrittenProps || {} : "all"
                }
                if (g) {
                    i = a || g, j = a !== d && "all" !== d && a !== g && ("object" != typeof a || !a._tempKill);
                    for (e in i)(f = g[e]) && (f.pg && f.t._kill(i) && (h = !0), f.pg && 0 !== f.t._overwriteProps.length || (f._prev ? f._prev._next = f._next : f === this._firstPT && (this._firstPT = f._next), f._next && (f._next._prev = f._prev), f._next = f._prev = null), delete g[e]), j && (d[e] = 1);
                    !this._firstPT && this._initted && this._enabled(!1, !1)
                }
            }
            return h
        }, f.invalidate = function () {
            return this._notifyPluginsOfEnabled && F._onPluginEvent("_onDisable", this), this._firstPT = this._overwrittenProps = this._startAt = this._onUpdate = null, this._notifyPluginsOfEnabled = this._active = this._lazy = !1, this._propLookup = this._targets ? {} : [], C.prototype.invalidate.call(this), this.vars.immediateRender && (this._time = -k, this.render(-this._delay)), this
        }, f._enabled = function (a, b) {
            if (h || g.wake(), a && this._gc) {
                var c, d = this._targets;
                if (d)for (c = d.length; --c > -1;)this._siblings[c] = T(d[c], this, !0); else this._siblings = T(this.target, this, !0)
            }
            return C.prototype._enabled.call(this, a, b), this._notifyPluginsOfEnabled && this._firstPT ? F._onPluginEvent(a ? "_onEnable" : "_onDisable", this) : !1
        }, F.to = function (a, b, c) {
            return new F(a, b, c)
        }, F.from = function (a, b, c) {
            return c.runBackwards = !0, c.immediateRender = 0 != c.immediateRender, new F(a, b, c)
        }, F.fromTo = function (a, b, c, d) {
            return d.startAt = c, d.immediateRender = 0 != d.immediateRender && 0 != c.immediateRender, new F(a, b, d)
        }, F.delayedCall = function (a, b, c, d, e) {
            return new F(b, 0, {
                delay: a,
                onComplete: b,
                onCompleteParams: c,
                onCompleteScope: d,
                onReverseComplete: b,
                onReverseCompleteParams: c,
                onReverseCompleteScope: d,
                immediateRender: !1,
                useFrames: e,
                overwrite: 0
            })
        }, F.set = function (a, b) {
            return new F(a, 0, b)
        }, F.getTweensOf = function (a, b) {
            if (null == a)return [];
            a = "string" != typeof a ? a : F.selector(a) || a;
            var c, d, e, f;
            if ((n(a) || G(a)) && "number" != typeof a[0]) {
                for (c = a.length, d = []; --c > -1;)d = d.concat(F.getTweensOf(a[c], b));
                for (c = d.length; --c > -1;)for (f = d[c], e = c; --e > -1;)f === d[e] && d.splice(c, 1)
            } else for (d = T(a).concat(), c = d.length; --c > -1;)(d[c]._gc || b && !d[c].isActive()) && d.splice(c, 1);
            return d
        }, F.killTweensOf = F.killDelayedCallsTo = function (a, b, c) {
            "object" == typeof b && (c = b, b = !1);
            for (var d = F.getTweensOf(a, b), e = d.length; --e > -1;)d[e]._kill(c, a)
        };
        var W = r("plugins.TweenPlugin", function (a, b) {
            this._overwriteProps = (a || "").split(","), this._propName = this._overwriteProps[0], this._priority = b || 0, this._super = W.prototype
        }, !0);
        if (f = W.prototype, W.version = "1.10.1", W.API = 2, f._firstPT = null, f._addTween = function (a, b, c, d, e, f) {
                var g, h;
                return null != d && (g = "number" == typeof d || "=" !== d.charAt(1) ? Number(d) - c : parseInt(d.charAt(0) + "1", 10) * Number(d.substr(2))) ? (this._firstPT = h = {
                    _next: this._firstPT,
                    t: a,
                    p: b,
                    s: c,
                    c: g,
                    f: "function" == typeof a[b],
                    n: e || b,
                    r: f
                }, h._next && (h._next._prev = h), h) : void 0
            }, f.setRatio = function (a) {
                for (var b, c = this._firstPT, d = 1e-6; c;)b = c.c * a + c.s, c.r ? b = Math.round(b) : d > b && b > -d && (b = 0), c.f ? c.t[c.p](b) : c.t[c.p] = b, c = c._next
            }, f._kill = function (a) {
                var b, c = this._overwriteProps, d = this._firstPT;
                if (null != a[this._propName])this._overwriteProps = []; else for (b = c.length; --b > -1;)null != a[c[b]] && c.splice(b, 1);
                for (; d;)null != a[d.n] && (d._next && (d._next._prev = d._prev), d._prev ? (d._prev._next = d._next, d._prev = null) : this._firstPT === d && (this._firstPT = d._next)), d = d._next;
                return !1
            }, f._roundProps = function (a, b) {
                for (var c = this._firstPT; c;)(a[this._propName] || null != c.n && a[c.n.split(this._propName + "_").join("")]) && (c.r = b), c = c._next
            }, F._onPluginEvent = function (a, b) {
                var c, d, e, f, g, h = b._firstPT;
                if ("_onInitAllProps" === a) {
                    for (; h;) {
                        for (g = h._next, d = e; d && d.pr > h.pr;)d = d._next;
                        (h._prev = d ? d._prev : f) ? h._prev._next = h : e = h, (h._next = d) ? d._prev = h : f = h, h = g
                    }
                    h = b._firstPT = e
                }
                for (; h;)h.pg && "function" == typeof h.t[a] && h.t[a]() && (c = !0), h = h._next;
                return c
            }, W.activate = function (a) {
                for (var b = a.length; --b > -1;)a[b].API === W.API && (L[(new a[b])._propName] = a[b]);
                return !0
            }, q.plugin = function (a) {
                if (!(a && a.propName && a.init && a.API))throw"illegal plugin definition.";
                var b, c = a.propName, d = a.priority || 0, e = a.overwriteProps, f = {
                    init: "_onInitTween",
                    set: "setRatio",
                    kill: "_kill",
                    round: "_roundProps",
                    initAll: "_onInitAllProps"
                }, g = r("plugins." + c.charAt(0).toUpperCase() + c.substr(1) + "Plugin", function () {
                    W.call(this, c, d), this._overwriteProps = e || []
                }, a.global === !0), h = g.prototype = new W(c);
                h.constructor = g, g.API = a.API;
                for (b in f)"function" == typeof a[b] && (h[f[b]] = a[b]);
                return g.version = a.version, W.activate([g]), g
            }, d = a._gsQueue) {
            for (e = 0; e < d.length; e++)d[e]();
            for (f in o)o[f].func || a.console.log("GSAP encountered missing dependency: com.greensock." + f)
        }
        h = !1
    }
}("undefined" != typeof module && module.exports && "undefined" != typeof global ? global : this || window, "TweenMax"), function () {
    var b = {
        uuid: function (a) {
            function b() {
                return Math.floor(65536 * (1 + Math.random())).toString(16).substring(1)
            }

            if (a) {
                for (var c = ""; a--;)c += b();
                return c
            }
            return b() + b() + b() + b() + b() + b() + b() + b()
        }, changeURLPar: function (a, b, c) {
            var d, e = a.split("#")[0];
            if (-1 != e.indexOf("?")) {
                var f = "";
                f = e.substr(e.indexOf("?") + 1);
                var g, h = "", j = "", k = "0";
                if (-1 != f.indexOf("&")) {
                    g = f.split("&");
                    for (i in g) {
                        if (g[i].split("=")[0] == b) {
                            if ("" == c)continue;
                            j = c, k = "1"
                        } else j = g[i].split("=")[1];
                        h = h + g[i].split("=")[0] + "=" + j + "&"
                    }
                    h = h.substr(0, h.length - 1), "0" == k && "" != c && h == f && (h = h + "&" + b + "=" + c)
                } else-1 != f.indexOf("=") ? (g = f.split("="), g[0] == b ? (j = c, k = "1") : j = g[1], "" != j && (h = g[0] + "=" + j), "0" == k && h == f && "" != c && (h = h + "&" + b + "=" + c)) : "" != c && (h = b + "=" + c);
                d = e.substr(0, e.indexOf("?")), "" != h && (d = d + "?" + h)
            } else d = "" != c ? e + "?" + b + "=" + c : e;
            return a.indexOf("#") > 0 && (d = d + "#" + a.split("#")[1]), d
        }, getUrlParameterByName: function (a, b) {
            var c = a.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]"), d = new RegExp("[\\?&]" + c + "=([^&#]*)"), e = d.exec("undefined" != typeof b && b || location.search);
            return null == e ? null : decodeURIComponent(e[1].replace(/\+/g, " "))
        }, replaceUrlParameterByName: function (a, b, c) {
            var d = b.split("=")[1];
            return this.changeURLPar(c, a, d)
        }, getHashParameterByName: function (a) {
            var b = a.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]"), c = new RegExp("[\\#&]" + b + "=([^&#]*)"), d = c.exec(location.hash);
            return null == d ? null : decodeURIComponent(d[1].replace(/\+/g, " "))
        }, replaceHashParameterByName: function (a, b) {
            var c = a.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]"), d = new RegExp("[\\#&]" + c + "=([^&#]*)"), e = d.exec(location.hash);
            return location.hash.replace(e[0].substr(1), b)
        }, parseTemplate: function (a) {
            var b = null;
            return "function" == typeof a && (b = a), "string" == typeof a && (b = _.template(a)), b
        }, renderT: function (a, b, c, d, e) {
            if (!a)return !1;
            b || (b = {});
            var f = d || null, g = $.extend(!0, {}, b);
            if (f && "undefined" != typeof _gDebug && _gDebug && _g.debug && _g.debug.enabled && _g.debug.query_user_template(f) && !e && (a = _g.debug.query_user_template(f)), c) {
                var h = {};
                h[c] = g, g = h
            }
            var i = _g.parseTemplate(a);
            f && _g.debug && _g.debug.enabled && (_g.debug.template[f] = {
                data: g,
                template: "string" == typeof a ? a : a.textsource,
                debug: !0
            });
            var j = $(i(g));
            return f && _g.debug && _g.debug.enabled && (_g.debug.template[f].el = j), _g.generator && (_g.generator.autoWidget(j), (j.hasClass("c-slimscroll") || j.find(".c-slimscroll").length) && _g.generator.autoScroll(j)), j.find("[data-toggle=tooltip],.c-tooltip-btn").each(function () {
                var a = $(this), b = $(this).data().template;
                b ? require(["text!" + b], function () {
                    var c = require("text!" + b);
                    a.tooltip({template: c})
                }) : $(this).tooltip()
            }), j
        }, domExist: function (a, b) {
            return b || (b = document), "string" == typeof a && (a = $(a)), jQuery.contains(b.documentElement, a[0])
        }, browserSupport: function (a) {
            var b = !1, c = {msie: 1, chrome: 1, mozilla: 1, safari: 1, opera: 1, success: null, fail: null};
            a = a ? $.extend(!0, {}, c, a) : $.extend(!0, {}, c);
            var d = parseInt($.browser.version, 10);
            return $.browser.msie && 1 == a.msie || $.browser.chrome && 1 == a.chrome || $.browser.mozilla && 1 == a.mozilla || $.browser.safari && 1 == a.safrai && $.browser.opera && 1 == a.opera ? b = !0 : $.browser.msie && 0 == a.msie || $.browser.chrome && 0 == a.chrome || $.browser.mozilla && 0 == a.mozilla || $.browser.safari && 0 == a.safrai && $.browser.opera && 0 == a.opera ? b = !1 : ($.browser.msie && (b = d >= a.msie), $.browser.chrome && (b = d >= a.chrome), $.browser.mozilla && (b = d >= a.mozilla), $.browser.opera && (b = d >= a.opera), $.browser.safari && (b = d >= a.safari)), b ? a.success && a.success() : a.fail && a.fail(), b
        }, array: {
            moveup: function (a, b) {
                var c = a.indexOf(b);
                return c > 0 && (a = _g.array.swap(a, c, c - 1)), a
            }, movedown: function (a, b) {
                var c = a.indexOf(b);
                return c < a.length && (a = _g.array.swap(a, c, c + 1)), a
            }, swap: function (a, b, c) {
                return a[b] = a.splice(c, 1, a[b])[0], a
            }, move2first: function (a, b) {
                var c = [];
                for (c.push(b), i = 0; i < a.length; i++)a[i] != b && c.push(a[i]);
                return c
            }, move2last: function (a, b) {
                var c = [];
                for (i = 0; i < a.length; i++)a[i] != b && c.push(a[i]);
                return c.push(b), c
            }, randomPick: function (a) {
                return a[Math.floor(Math.random() * a.length)]
            }, maptree: function (a) {
                var b = {treesource: null, mapdata: null, idAttribute: "id"};
                if (a = a ? $.extend(!0, {}, b, a) : $.extend(!0, {}, b), !a.treesource || !a.mapdata)return [];
                var c = [];
                return _.each(a.treesource, function (b) {
                    b.children && (b.children = _g.array.maptree({
                        treesource: b.children,
                        mapdata: a.mapdata,
                        idAttribute: a.idAttribute
                    }));
                    var d = _.find(a.mapdata, function (c) {
                        return c[a.idAttribute] == b[a.idAttribute]
                    });
                    d && (b = $.extend(!0, b, d)), c.push(b)
                }), c
            }, toDict: function (a, b) {
                var c, d = {};
                for (i = 0; i < a.length; i++)c = a[i][b], d[c] = a[i];
                return d
            }, treeToList: function (a, b, c) {
                var d = {childrenKey: "children", parentKey: "parent", idAttribute: "id"};
                if (b = b ? $.extend(!0, {}, d, b) : $.extend(!0, {}, d), !a)return [];
                var e = [];
                return _.each(a, function (d) {
                    if (d[b.childrenKey].length) {
                        var f = _g.array.toTreeList(d[b.childrenKey], b, c ? c : a);
                        for (j = 0; j < f.length; j++)e.push(f[j]);
                        d.children = _.pluck(d.children, "id")
                    } else delete d.children;
                    e.push(d)
                }), e
            }, listToTree: function (a, b, c) {
                var d = {childrenKey: "children", parentKey: "parent", idAttribute: "id"};
                b = b ? $.extend(!0, {}, d, b) : $.extend(!0, {}, d);
                var e = [];
                return c && (a = _.map(a, function (a) {
                    return "string" == typeof a && (a = _.find(c, function (c) {
                        return c[b.idAttribute] == a
                    })), a
                })), _.each(a, function (d) {
                    var f = $.extend(!0, {}, d);
                    c || f[b.parentKey], f[b.childrenKey] && f[b.childrenKey].length ? (f[b.childrenKey] = _g.array.listToTree(f[b.childrenKey], b, c ? c : a), e.push(f)) : e.push(f)
                }), e
            }
        }, object: {
            jsonparse: function (b) {
                if (!b)return null;
                try {
                    return a = JSON.parse(b)
                } catch (c) {
                    return b
                }
            }, equal: function () {
            }, treeToArray: function () {
            }, getKeyByValue: function (a, b) {
                try {
                    var c = _.keys(a)[_.values(a).indexOf(b)];
                    return c
                } catch (d) {
                    return void 0
                }
            }
        }, string: {
            randomGenerate: function (a) {
                a = a ? a : 10;
                for (var b = "", c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890", d = 0; a > d; d++)b += c.charAt(Math.floor(Math.random() * c.length));
                return b
            }, getUrlExt: function (a) {
                return a.match(/(.[^.]+|)$/)[0]
            }, getUrlNameWithOutExt: function (a) {
                return a.substr(0, a.lastIndexOf(".")) || a
            }, getFileNameByPath: function (a) {
                return a.replace(/^.*[\\\/]/, "")
            }, string2boolean: function (a) {
                return "true" == a ? !0 : !1
            }, capitalize: function (a) {
                return a = a.substring(0, 1).toUpperCase() + a.substring(1)
            }, rmfirst: function (a) {
                return a.replace(/^.(\s+)?/, "")
            }, rmlast: function (a) {
                return a.replace(/(\s+)?.$/, "")
            }, isPureEng: function (a) {
                var b = a;
                if ("" == b)return !0;
                for (var c = 0; c < b.length; c++)if (!(b.charCodeAt(c) >= 48 && b.charCodeAt(c) <= 57 || b.charCodeAt(c) >= 65 && b.charCodeAt(c) <= 90 || b.charCodeAt(c) >= 97 && b.charCodeAt(c) <= 122))return !1;
                return !0
            }, isEng: function (a) {
                var b = a;
                if ("" == b)return !0;
                for (var c = 0; c < b.length; c++)if (!(32 == b.charCodeAt(c) || b.charCodeAt(c) >= 48 && b.charCodeAt(c) <= 57 || b.charCodeAt(c) >= 65 && b.charCodeAt(c) <= 90 || b.charCodeAt(c) >= 97 && b.charCodeAt(c) <= 122))return !1;
                return !0
            }, isPureChi: function (a) {
                var b = a;
                if ("" == b)return !0;
                for (var c = 0; c < b.length; c++)if (!(b.charCodeAt(c) >= 19968 && b.charCodeAt(c) <= 64041))return !1;
                return !0
            }, isChi: function (a) {
                var b = a;
                if ("" == b)return !0;
                for (var c = 0; c < b.length; c++)if (!(32 == b.charCodeAt(c) || b.charCodeAt(c) >= 19968 && b.charCodeAt(c) <= 64041))return !1;
                return !0
            }, autoName: function (a, b, c, d) {
                a || (a = ""), c || (c = ""), d || (d = 1);
                var e = a + d + c;
                return -1 != b.indexOf(e) ? _g.string.autoName(a, b, c, d + 1) : e
            }
        }, "boolean": {
            randomPick: function () {
                return !!Math.round(1 * Math.random())
            }
        }, number: {
            random: function (a, b) {
                return "undefined" == typeof a && (a = 0), "undefined" == typeof b && (b = 100), Math.random() * (b - a) + a
            }, randomInt: function (a, b) {
                return "undefined" == typeof a && (a = 0), "undefined" == typeof b && (b = 100), Math.floor(Math.random() * (b - a + 1)) + a
            }, round: function (a, b) {
                var c = a;
                void 0 == typeof b && (b = .5);
                var d = parseInt(a), e = a - d;
                c = b > e ? d : d + 1
            }, rgbToHex: function (a, b, c) {
                return "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1)
            }, hexToRgb: function (a) {
                var b = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
                a = a.replace(b, function (a, b, c, d) {
                    return b + b + c + c + d + d
                });
                var c = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a);
                return c ? {r: parseInt(c[1], 16), g: parseInt(c[2], 16), b: parseInt(c[3], 16)} : null
            }, decimal: function (a, b) {
                return Number(a.toFixed(b))
            }
        }, hasTouch: function () {
            try {
                return document.createEvent("TouchEvent"), !0
            } catch (a) {
                return !1
            }
        }(), inIframe: function () {
            try {
                return window.self !== window.top
            } catch (a) {
                return !0
            }
        }, supportFlash: function () {
            return "undefined" != typeof swfobject && 0 !== swfobject.getFlashPlayerVersion().major ? !0 : !1
        }, isMSIE11: function () {
            return !!navigator.userAgent.match(/Trident\/7\./)
        }, getRGBA: function (a, b) {
            if (b = void 0 != b ? Number(b) : 1, !a)return "transparent";
            if (-1 != a.indexOf("rgb("))var c = a.replace(/rgb\((.*)\)/, "$1").split(","), d = "rgba(" + c[0] + "," + c[1] + "," + c[2] + "," + b + ")"; else {
                var c = _g.number.hexToRgb(a);
                if (c)var d = "rgba(" + c.r + "," + c.g + "," + c.b + "," + b + ")"; else d = "rgba(255,255,255,1)"
            }
            return d
        }, weixinShare: function () {
            if ("undefined" != typeof wx_permissions && wx_permissions.onMenuShareTimeline) {
                var a = message_link + (message_link.indexOf("disableHistoryStart=0") >= 0 ? "#page/" + interaction_view.currentPage : ""), b = shareTitle == bookTitle ? descContent : shareTitle;
                wx.onMenuShareAppMessage({
                    title: bookTitle, desc: b, link: a, imgUrl: imgUrl, trigger: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "appmessage", "click"])
                    }, success: function () {
                        _gaq.push(["_trackSocial", "Wechat", "appmessage", ga_opt_target, ga_opt_pagePath])
                    }, cancel: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "appmessage", "cancel"])
                    }, fail: function (a) {
                        _gaq.push(["_trackEvent", "error", "weixinjsapi", "appmessage", JSON.stringify(a)])
                    }
                }), wx.onMenuShareTimeline({
                    title: shareTitle, link: a, imgUrl: imgUrl, trigger: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "timeline", "click"])
                    }, success: function () {
                        _gaq.push(["_trackSocial", "Wechat", "timeline", ga_opt_target, ga_opt_pagePath])
                    }, cancel: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "timeline", "cancel"])
                    }, fail: function (a) {
                        _gaq.push(["_trackEvent", "error", "weixinjsapi", "timeline", JSON.stringify(a)])
                    }
                }), wx.onMenuShareQQ({
                    title: bookTitle, desc: b, link: a, imgUrl: imgUrl, trigger: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "QQ", "click"])
                    }, complete: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "QQ", "complete"])
                    }, success: function () {
                        _gaq.push(["_trackSocial", "Wechat", "QQ", ga_opt_target, ga_opt_pagePath])
                    }, cancel: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "QQ", "cancel"])
                    }, fail: function (a) {
                        _gaq.push(["_trackEvent", "error", "weixinjsapi", "QQ", JSON.stringify(a)])
                    }
                }), wx.onMenuShareWeibo({
                    title: shareTitle,
                    desc: descContent,
                    link: message_link,
                    imgUrl: imgUrl,
                    trigger: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "Weibo", "click"])
                    },
                    complete: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "Weibo", "complete"])
                    },
                    success: function () {
                        _gaq.push(["_trackSocial", "Wechat", "Weibo", ga_opt_target, ga_opt_pagePath])
                    },
                    cancel: function () {
                        _gaq.push(["_trackEvent", "weixin", "share", "Weibo", "cancel"])
                    },
                    fail: function (a) {
                        _gaq.push(["_trackEvent", "error", "weixinjsapi", "Weibo", JSON.stringify(a)])
                    }
                })
            }
        }
    };
    "undefined" == typeof require ? (window._g || (window._g = {}), window._g = $.extend(!0, {}, window._g, b), b = void 0) : define(["jquery", "backbone"], function () {
        return window._g || (window._g = {}), window._g = $.extend(!0, {}, window._g, b), b = void 0, window._g
    })
}(window), function () {
    var a, b, c, d, e, f, g, h, i, j = {};
    b = window.document.documentElement, i = window.navigator.userAgent.toLowerCase(), j.ios = function () {
        return j.iphone() || j.ipod() || j.ipad()
    }, j.iphone = function () {
        return c("iphone")
    }, j.ipod = function () {
        return c("ipod")
    }, j.ipad = function () {
        return c("ipad")
    }, j.android = function () {
        return c("android")
    }, j.androidPhone = function () {
        return j.android() && c("mobile")
    }, j.androidTablet = function () {
        return j.android() && !c("mobile")
    }, j.blackberry = function () {
        return c("blackberry") || c("bb10") || c("rim")
    }, j.blackberryPhone = function () {
        return j.blackberry() && !c("tablet")
    }, j.blackberryTablet = function () {
        return j.blackberry() && c("tablet")
    }, j.windows = function () {
        return c("windows")
    }, j.mac = function () {
        return c("mac")
    }, j.linux = function () {
        return c("linux")
    }, j.windowsPhone = function () {
        return j.windows() && c("phone")
    }, j.windowsTablet = function () {
        return j.windows() && c("touch")
    }, j.fxos = function () {
        return (c("(mobile;") || c("(tablet;")) && c("; rv:")
    }, j.fxosPhone = function () {
        return j.fxos() && c("mobile")
    }, j.fxosTablet = function () {
        return j.fxos() && c("tablet")
    }, j.meego = function () {
        return c("meego")
    }, j.mobile = function () {
        return j.androidPhone() || j.iphone() || j.ipod() || j.windowsPhone() || j.blackberryPhone() || j.fxosPhone() || j.meego()
    }, j.tablet = function () {
        return j.ipad() || j.androidTablet() || j.blackberryTablet() || j.windowsTablet() || j.fxosTablet()
    }, j.msie = function () {
        return $.browser.msie || !!navigator.userAgent.match(/Trident\/7\./)
    }, j.portrait = function () {
        return 90 !== Math.abs(window.orientation)
    }, j.landscape = function () {
        return 90 === Math.abs(window.orientation)
    }, j.noConflict = function () {
        return this
    }, j.svg = function () {
        return document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#Shape", "1.1")
    }, j.online = function (a, b, c) {
        var d = new Image;
        d.onload = function () {
            b && b.constructor == Function && b()
        }, d.onerror = function () {
            c && c.constructor == Function && c()
        }, d.src = a + "?t=" + _g.uuid()
    }, j.screenSize = function () {
        var a = window, b = document, c = b.documentElement, d = b.getElementsByTagName("body")[0], e = a.innerWidth || c.clientWidth || d.clientWidth, f = a.innerHeight || c.clientHeight || d.clientHeight;
        return {x: e, y: f}
    }, j.isWeixin = function () {
        var a = navigator.userAgent.toLowerCase();
        return /micromessenger/.test(a) ? !0 : !1
    }, c = function (a) {
        return -1 !== i.indexOf(a)
    }, e = function (a) {
        var c;
        return c = new RegExp(a, "i"), b.className.match(c)
    }, a = function (a) {
        return e(a) ? void 0 : b.className += " " + a
    }, g = function (a) {
        return e(a) ? b.className = b.className.replace(a, "") : void 0
    };
    var k = function () {
        j.ios() ? j.ipad() ? a("ios ipad tablet") : j.iphone() ? a("ios iphone mobile") : j.ipod() && a("ios ipod mobile") : a(j.android() ? j.androidTablet() ? "android tablet" : "android mobile" : j.blackberry() ? j.blackberryTablet() ? "blackberry tablet" : "blackberry mobile" : j.windows() ? j.windowsTablet() ? "windows tablet" : j.windowsPhone() ? "windows mobile" : "desktop" : j.fxos() ? j.fxosTablet() ? "fxos tablet" : "fxos mobile" : j.meego() ? "meego mobile" : "desktop")
    };
    d = function () {
        return j.landscape() ? (g("portrait"), a("landscape")) : (g("landscape"), a("portrait"))
    }, h = "onorientationchange" in window, f = h ? "orientationchange" : "resize", window.addEventListener ? window.addEventListener(f, d, !1) : window.attachEvent ? window.attachEvent(f, d) : window[f] = d, d(), j.initDom = k, window._g_device = j, "undefined" == typeof require ? (window._g || (window._g = {}), window._g.device = _g_device) : define(["_g/base"], function () {
        return window._g.device = _g_device, window._g.device
    })
}(window), function () {
    var a = {
        bind: function (a) {
            var b, c, d = 0, e = 0;
            a.callback || (a.callback = function () {
                return !0
            }), $(a.el).hammer().on("dragstart", function (c) {
                (!a.canDrag || a.canDrag(c)) && (a.dragstart && a.dragstart(c), b = !0)
            }), $(a.el).hammer().on("dragleft", function (e) {
                return null == c && (c = 1), a.canDragX && !a.canDragX(e) || !_g.dragcontrol._testDragEventAccess(e, c) ? void 0 : (b = !0, $.zoom && 1 != $.zoom && (e.gesture.deltaX = e.gesture.deltaX / $.zoom), d = e.gesture.deltaX, a.dragleft && a.dragleft(e), e.gesture.preventDefault(), !1)
            }), $(a.el).hammer().on("dragright", function (e) {
                return null == c && (c = 1), a.canDragX && !a.canDragX(e) || !_g.dragcontrol._testDragEventAccess(e, c) ? void 0 : (b = !0, $.zoom && 1 != $.zoom && (e.gesture.deltaX = e.gesture.deltaX / $.zoom), d = e.gesture.deltaX, a.dragright && a.dragright(e), e.gesture.preventDefault(), !1)
            }), $(a.el).hammer().on("dragup", function (d) {
                return null == c && (c = 2), a.canDragY && !a.canDragY(d) || !_g.dragcontrol._testDragEventAccess(d, c) ? void 0 : (b = !0, $.zoom && 1 != $.zoom && (d.gesture.deltaY = d.gesture.deltaY / $.zoom), e = d.gesture.deltaY, a.dragup && a.dragup(d), d.gesture.preventDefault(), !1)
            }), $(a.el).hammer().on("dragdown", function (d) {
                return null == c && (c = 2), a.canDragY && !a.canDragY(d) || !_g.dragcontrol._testDragEventAccess(d, c) ? void 0 : (b = !0, $.zoom && 1 != $.zoom && (d.gesture.deltaY = d.gesture.deltaY / $.zoom), e = d.gesture.deltaY, a.dragdown && a.dragdown(d), d.gesture.preventDefault(), !1)
            }), $(a.el).hammer().on("dragend", function (f) {
                return b || (c = null), a.canDrag && !a.canDrag(f) || !_g.dragcontrol._testDragEventAccess(f, c) ? void 0 : ((1 == c && d || 2 == c && e) && ($.zoom && 1 != $.zoom && (2 == c && e && (f.gesture.deltaY = f.gesture.deltaY / $.zoom), 1 == c && d && (f.gesture.deltaX = f.gesture.deltaX / $.zoom)), a.dragend && a.dragend(f)), b = !1, c = null, d = 0, e = 0, f.gesture.preventDefault(), !1)
            })
        }, _testDragEventAccess: function (a, b) {
            var c = !0;
            return 1 == b && ("dragup" == a.type || "dragdown" == a.type) && (c = !1), 2 == b && ("dragleft" == a.type || "dragright" == a.type) && (c = !1), "dragend" == a.type && (b || (c = !1)), c
        }
    };
    "undefined" == typeof require ? (window._g || (window._g = {}), window._g.dragcontrol = a) : define(["_g/base", "jquery.hammer"], function () {
        return window._g.dragcontrol = a, window._g.dragcontrol
    })
}(window), function () {
    var a = {
        support: function () {
            return !!document.createElement("video").canPlayType
        }(), medias: [], collect: function (a, b) {
            _g.html5media.support && (a || (a = document), b || (b = "id"), $(a).find("video,audio").each(function () {
                var a = {
                    media: this,
                    duration: 0,
                    currentTime: 0,
                    timer: 0,
                    seekx: 0,
                    seekPos: 0,
                    buffered: 0,
                    timerBuffer: 0,
                    type: "VIDEO" == this.tagName ? "video" : "audio",
                    autoplay: $(this).attr("autoplay"),
                    id: $(this).attr(b)
                };
                _g.html5media.medias.push(a), this.addEventListener("ended", function () {
                }, !0), this.addEventListener("play", function () {
                }, !0), this.addEventListener("timeupdate", function () {
                }, !0), this.addEventListener("pause", function () {
                }, !0)
            }))
        }, findById: function (a) {
            return _g.html5media.support ? _.find(_g.html5media.medias, function (b) {
                return b.id == a
            }) : null
        }, play: function (a) {
            var b = _g.html5media.findById(a);
            try {
                b.media.play()
            } catch (c) {
            }
        }, pause: function (a) {
            var b = _g.html5media.findById(a);
            try {
                b.media.pause()
            } catch (c) {
            }
        }, pauseAll: function () {
            _.each(_g.html5media.medias, function (a) {
                _g.html5media.pause(a.id)
            })
        }, stopAll: function () {
            _.each(_g.html5media.medias, function (a) {
                _g.html5media.stop(a.id)
            })
        }, stop: function (a) {
            var b = _g.html5media.findById(a);
            try {
                b.media.pause(), b.media.currentTime = 0
            } catch (c) {
            }
        }, toggle: function (a) {
            var b = _g.html5media.findById(a);
            try {
                b.media.paused ? b.media.play() : b.media.pause()
            } catch (c) {
            }
        }
    };
    "undefined" == typeof require ? (window._g || (window._g = {}), window._g.html5media = a) : define(["_g/base", "underscore"], function () {
        return window._g.html5media = a, window._g.html5media
    })
}(window), function () {
    var _g_mvc = {
        createModel: function (opts) {
            var defaults = {
                defaults: {},
                autoIndex: !0,
                autoUpdate: !0,
                autoRemove: !0,
                enableSync: !0,
                createUrl: null,
                updateUrl: null,
                removeUrl: null,
                fetchUrl: null,
                staticFetchUrl: null,
                staticRemoveUrl: null,
                staticCreateUrl: null,
                staticUpdateUrl: null,
                fetchUrlName: null,
                removeUrlName: null,
                createUrlName: null,
                updateUrlName: null,
                restful: !1,
                debug: !1,
                bindChange: null,
                bindRemove: null,
                callback: null,
                initView: null,
                patchKeys: null,
                initialize: function () {
                    if (this.iViewlist = [], this.iCollectionlist = [], this.get("id"))this.preset(); else if (this.set("isNew", !0), this.autoIndex) {
                        var prefix = this.get("type") || this.get("iType") || "M";
                        this.set("id", prefix + "_" + _g.uuid()), this.preset()
                    } else this.save({}, {
                        wait: !0, success: function (model, response) {
                            var returned = eval(response);
                            ("Success" == returned.Status || 200 == returned.code) && model.set("id", returned.ID.toString()), model.preset()
                        }
                    })
                },
                addView: function (a, b) {
                    if ("function" == typeof b && (this[a] = new b({model: this})), "object" == typeof b) {
                        var c = _g.mvc.createView(b);
                        this[a] = new c({model: this})
                    }
                    this[a] && this.iViewlist.push(this[a])
                },
                addCollection: function (a, b) {
                    if ("function" == typeof b && (this[a] = new b), "object" == typeof view) {
                        var c = _g.mvc.createCollection(b);
                        this[a] = new c
                    }
                    this[a] && this.iCollectionlist.push(this[a])
                },
                preset: function () {
                    this.callback && this.callback(this);
                    var a = this;
                    this.autoUpdate && this.on("change", function () {
                        a.updateAllViews()
                    }), this.autoRemove && this.on("destroy", function (a, b, c) {
                        a.removeAllViews(), a.bindRemove && a.bindRemove(a, c)
                    }), this.bindChange && this.bindChange(), this.initView && this.addView("iview", this.initView)
                },
                updateAllViews: function () {
                    _.each(this.iViewlist, function (a) {
                        a.$el && a.update()
                    })
                },
                removeView: function (a) {
                    this[a] && (this[a].$el.remove(), this.iViewlist = _.reject(this.iViewlist, function (b) {
                        return b == this[a]
                    }), this[a] = null)
                },
                removeAllViews: function (a) {
                    _.each(this.iViewlist, function (b) {
                        b.$el && (a ? b.undelegateEvents() : b.$el.remove())
                    })
                }
            };
            opts = opts ? $.extend(!0, {}, defaults, opts) : defaults;
            var Model = Backbone.Model.extend(opts);
            return Model
        }, createView: function (a) {
            var b = {
                template: null,
                className: null,
                containment: null,
                wrap: null,
                wrapClassName: null,
                autoRender: !0,
                position: 1,
                parseData: null,
                callback: null,
                bindChange: null,
                parseTemplate: null,
                templateKey: null,
                templateName: null,
                afterRender: null,
                afterUpdate: null,
                initialize: function () {
                    _.bindAll(this), this.autoRender && this.render(), this.callback && this.callback(this)
                },
                createEl: function () {
                    var a, b = this.model.toJSON();
                    return this.parseData && (b = this.parseData()), a = this.parseTemplate ? this.parseTemplate(this.template) : this.template, _g.renderT(a, b, this.templateKey, this.templateName)
                },
                render: function (a, b) {
                    if (!this.model || !this.template)return !1;
                    if (!_g.domExist(this.$el)) {
                        if (!a && !this.containment)return !1;
                        a || (a = $(this.containment)), b || (b = this.position), this.wrap && !$(this.containment).is(this.wrap) && (0 == $(this.containment).children(this.wrap).length && $(this.containment).append(document.createElement(this.wrap)), a = $(this.containment).children(this.wrap), this.containment && this.wrapClassName && a.addClass(this.wrapClassName));
                        var c = this.createEl(), d = c;
                        return this.setElement(d), 1 == b ? a.append(d) : a.prepend(d), this.className && this.$el.addClass(this.className), this.afterRender && this.afterRender(this), this
                    }
                    var c = this.createEl(), d = c;
                    this.$el.replaceWith(d), this.setElement(d), this.afterUpdate && this.afterUpdate(this)
                },
                update: function () {
                    this.render()
                },
                afterUpdate: function () {
                    this.afterRender && this.afterRender(this)
                },
                events: {}
            };
            a = a ? $.extend(!0, {}, b, a) : b;
            var c = Backbone.View.extend(a);
            return c
        }, createCollection: function (a) {
            var b = {
                enableSync: !1,
                fetchUrl: null,
                staticFetchUrl: null,
                saveUrl: null,
                staticSaveUrl: null,
                debug: !1,
                bindRemove: !1,
                bindReset: !0,
                bindAdd: null,
                callback: null,
                patchKeys: null,
                name: null,
                initialize: function () {
                    var a = this;
                    this.bindRemove && this.on("remove", function (b) {
                        "function" == typeof a.bindRemove ? a.bindRemove(b) : b.removeAllViews()
                    }), this.bindReset && this.on("reset", function (b, c) {
                        "function" == typeof a.bindReset ? a.bindReset(b, c) : _.each(c.previousModels, function (a) {
                            a.removeAllViews()
                        }), a.afterReset && a.afterReset(b, c)
                    }), this.bindAdd && this.on("add", function () {
                        a.bindAdd()
                    }), this.callback && this.callback(this)
                },
                refreshView: function (a) {
                    var b = {containment: null, viewname: null};
                    a = a ? $.extend({}, b, a) : b, this.length > 0 && (_.each(this.at(0).iViewlist, function (b) {
                        containment = a.containment || b.containment, containment && (b.wrap && !$(containment).is(b.wrap) ? $(containment).children(b.wrap).empty() : $(containment).empty())
                    }), this.each(function (b) {
                        a.containment && (b.iview.containment = a.containment), a.viewname ? b[viewname].update() : b.iview.update()
                    }))
                },
                removeAllViews: function (a) {
                    this.each(function (b) {
                        b.removeAllViews(a)
                    })
                }
            };
            a = a ? $.extend(!0, {}, b, a) : b;
            var c = Backbone.Collection.extend(a);
            return c
        }
    };
    "undefined" == typeof require ? (window._g || (window._g = {}), window._g.mvc = _g_mvc, _g_mvc = void 0) : define(["jquery", "backbone", "_g/base"], function () {
        return window._g.mvc = _g_mvc, _g_mvc = void 0, window._g.mvc
    })
}(window), function () {
    var a = function (a) {
        this.init(a)
    };
    a.prototype = {
        isDraged: !1, init: function (a) {
            var b = {
                containment: null,
                containmentClass: "c-transition-containment",
                perspectiveClass: "c-perspective",
                itemClass: "c-transition-item",
                currentClass: "c-transition-current",
                leftClass: "c-transition-left",
                rightClass: "c-transition-right",
                upClass: "c-transition-up",
                downClass: "c-transition-down",
                activeClass: "c-transition-active",
                topClass: "c-transition-top",
                repeat: !1,
                direction: 0,
                type: 1,
                duration: 1e3,
                onStart: null,
                onEnd: null,
                control: !0,
                autoplay: !1,
                width: null,
                height: null,
                disableControlled: !1,
                autoplayDirection: -1,
                autoplayAxis: null
            };
            return this.opts = a ? $.extend(!0, {}, b, a) : b, this.opts.containment ? ($(this.opts.containment).addClass(this.opts.containmentClass), _.bindAll(this), this.opts.control && (this.control(), this.opts.disableControlled && this.disableControl()), this.opts.autostart ? (this.timerDisabled = !1, this.timerstart({})) : this.timerDisabled = !0, this) : !1
        }, disableControlled: !1, disableControl: function () {
            this.disableControlled = !0
        }, enableControl: function () {
            this.disableControlled = !1
        }, control: function () {
            var a = this;
            _g.dragcontrol.bind({
                el: this.opts.containment, dragstart: function (b) {
                    a.disableControlled || a.start(b)
                }, dragleft: function (b) {
                    a.disableControlled || a.dragX(b)
                }, dragright: function (b) {
                    a.disableControlled || a.dragX(b)
                }, dragup: function (b) {
                    a.disableControlled || a.dragY(b)
                }, dragdown: function (b) {
                    a.disableControled || a.dragY(b)
                }, dragend: function (b) {
                    if (!a.disableControlled) {
                        if (a.direction && !a.timerDisabled) {
                            var c = "x" == a.direction ? b.gesture.deltaX : b.gesture.deltaY;
                            a.TimerDirection = c > 0 ? 1 : -1
                        }
                        a.dragEnd(b)
                    }
                }, canDragX: function () {
                    return a.opts.autoplayAxis && "x" != a.opts.autoplayAxis ? !1 : !0
                }, canDragY: function () {
                    return a.opts.autoplayAxis && "y" != a.opts.autoplayAxis ? !1 : !0
                }
            })
        }, stashitemClass: function () {
            $(this.opts.containment).find("." + this.opts.itemClass).css({
                transform: "",
                "-moz-transform": "",
                "-webkit-transform": "",
                "-o-transform": "",
                "-ms-transform": "",
                opacity: ""
            }), this.stashClass = {
                current: $(this.opts.containment).find("." + this.opts.currentClass).attr("style"),
                left: $(this.opts.containment).find("." + this.opts.leftClass).attr("style"),
                right: $(this.opts.containment).find("." + this.opts.rightClass).attr("style"),
                up: $(this.opts.containment).find("." + this.opts.upClass).attr("style"),
                down: $(this.opts.containment).find("." + this.opts.downClass).attr("style")
            }, this.stashed = !0
        }, recoveritemClass: function () {
            if (this.stashed)try {
                this.currentItem.attr("style", this.stashClass.current || ""), this.activeItem.hasClass(this.opts.leftClass) ? this.activeItem.attr("style", this.stashClass.left || "") : this.activeItem.hasClass(this.opts.rightClass) ? this.activeItem.attr("style", this.stashClass.right || "") : this.activeItem.hasClass(this.opts.upClass) ? this.activeItem.attr("style", this.stashClass.up || "") : this.activeItem.hasClass(this.opts.downClass) && this.activeItem.attr("style", this.stashClass.down || "")
            } catch (a) {
            }
            $(this.opts.containment).find("." + this.opts.itemClass).css({
                transform: "",
                "-moz-transform": "",
                "-webkit-transform": "",
                "-o-transform": "",
                "-ms-transform": "",
                opacity: ""
            }), this.stashed = !1
        }, start: function (a, b) {
            this.isTransiting || (b || (b = this.opts.type), this.args = _g.transitionargs[b], this.args.perspective ? $(this.opts.containment).addClass(this.opts.perspectiveClass) : $(this.opts.containment).removeClass(this.opts.perspectiveClass), this.currentItem = $(this.opts.containment).find("." + this.opts.currentClass), this.currentItem.addClass(this.opts.topClass), this.stashitemClass())
        }, dragX: function (a) {
            if (!this.isTransiting && (a.gesture.deltaX <= 0 ? (this.plus = -1, this.activeItem = $(this.opts.containment).find("." + this.opts.rightClass)) : (this.plus = 1, this.activeItem = $(this.opts.containment).find("." + this.opts.leftClass)), this.activeItem.length)) {
                var b = a.gesture.deltaX;
                this.direction = "x", this.dragHandle(b)
            }
        }, dragY: function (a) {
            if (!this.isTransiting && (a.gesture.deltaY <= 0 ? (this.plus = -1, this.activeItem = $(this.opts.containment).find("." + this.opts.downClass)) : (this.plus = 1, this.activeItem = $(this.opts.containment).find("." + this.opts.upClass)), this.activeItem.length)) {
                var b = a.gesture.deltaY;
                this.direction = "y", this.dragHandle(b)
            }
        }, dragHandle: function (a) {
            isDraged = !0, $(this.opts.containment).find("." + this.opts.itemClass).removeClass(this.opts.activeClass), this.activeItem.addClass(this.opts.activeClass), this.currentItem = $(this.opts.containment).find("." + this.opts.currentClass);
            var b = Math.abs(a) / $(this.opts.containment).width();
            if (_g.browserSupport({msie: 9}))if (this.args.percentcontrol) {
                for (i = 0; i < this.args.percentcontrol.length; i++)if (b <= this.args.percentcontrol[i]) {
                    if (this.args[this.args.percentcontrol[i]][this.direction].css) {
                        var c = this.args[this.args.percentcontrol[i]][this.direction].css;
                        c.currentItem && this.currentItem.css(this.getArgs(c.currentItem, this.plus, b)), c.activeItem && this.activeItem.css(this.getArgs(c.activeItem, this.plus, b))
                    }
                    this.activeItem.css(this.getArgs(this.args[this.args.percentcontrol[i]][this.direction].activeItem, this.plus, b)), this.currentItem.css(this.getArgs(this.args[this.args.percentcontrol[i]][this.direction].currentItem, this.plus, b));
                    break
                }
            } else {
                if (this.args[this.direction].css) {
                    var c = this.args[this.direction].css;
                    c.currentItem && this.currentItem.css(this.getArgs(c.currentItem, this.plus, b)), c.activeItem && this.activeItem.css(this.getArgs(c.activeItem, this.plus, b))
                }
                this.activeItem.css(this.getArgs(this.args[this.direction].activeItem, this.plus, b)), this.currentItem.css(this.getArgs(this.args[this.direction].currentItem, this.plus, b))
            } else this.currentItem.css("x" == this.direction ? "margin-left" : "margin-top", this.plus * b * 100 + "%"), this.activeItem.css("x" == this.direction ? "margin-left" : "margin-top", -this.plus * (1 - b) * 100 + "%");
            this.args.currentTop ? this.currentItem.addClass(this.opts.topClass) : this.currentItem.removeClass(this.opts.topClass), this.args.activeTop && this.activeItem.addClass(this.opts.topClass), this.opts.onTransition && this.opts.onTransition(event, b)
        }, dragEnd: function (a) {
            if (!this.isTransiting && this.currentItem.length && this.activeItem.length) {
                var b = this;
                this.isTransiting = !0;
                var c = "x" == this.direction ? a.gesture.deltaX : a.gesture.deltaY, d = Math.abs(c) / $(this.opts.containment).width();
                if (_g.browserSupport({msie: 9}))if (this.args.percentcontrol) {
                    for (this.percent = d, i = 0; i < this.args.percentcontrol.length; i++)if (d <= this.args.percentcontrol[i]) {
                        this.transitPercent(i);
                        break
                    }
                } else {
                    var e = 1200, f = this.getArgs(this.args[this.direction].currentItem, this.plus, 1);
                    f.duration = e, f.easing = this.args.currentEasing;
                    var g = this.getArgs(this.args[this.direction].activeItem, this.plus, 1);
                    g.duration = e, g.easing = this.args.activeEasing, g.complete = function () {
                        b.isTransiting = !1, b.onTransitionEnd()
                    }, this.currentItem.transit(f), this.activeItem.transit(g)
                } else this.activeItem.css("x" == this.direction ? "margin-left" : "margin-top", "0%"), this.currentItem.css("x" == this.direction ? "margin-left" : "margin-top", 100 * -this.plus + "%")
            }
        }, onTransitionEnd: function () {
            var a = this;
            this.recoveritemClass(), this.currentItem.removeClass(this.opts.currentClass), this.activeItem.addClass(this.opts.currentClass).removeClass(this.opts.activeClass).removeClass(this.opts.upClass).removeClass(this.opts.rightClass).removeClass(this.opts.leftClass).removeClass(this.opts.downClass), $(this.opts.containment).find("." + this.opts.itemClass).removeClass(this.opts.topClass);
            var b = this.currentItem.index(), c = this.activeItem.index();
            $(this.opts.containment).removeClass(this.opts.perspectiveClass), a.opts.onEnd && a.opts.onEnd(b, c), this.timerStart()
        }, transitPercent: function (a) {
            var b = this;
            if (a < this.args.percentcontrol.length) {
                var b = this, c = this.opts.duration * (this.args.percentcontrol[a] - this.percent), d = this.getArgs(this.args[this.args.percentcontrol[a]][this.direction].currentItem, this.plus, this.args.percentcontrol[a]);
                d.duration = c, d.easing = this.args.currentEasing;
                var e = this.getArgs(this.args[this.args.percentcontrol[a]][this.direction].activeItem, this.plus, this.args.percentcontrol[a]);
                e.duration = c, e.easing = this.args.activeEasing, e.complete = function () {
                    b.transitPercent(a + 1)
                }, this.percent = this.args.percentcontrol[a], this.currentItem.transit(d), this.activeItem.transit(e)
            } else b.isTransiting = !1, this.onTransitionEnd()
        }, getArgs: function (a, b, c) {
            var d = {};
            return _.each(a, function (a, e) {
                d[e] = "function" == typeof a ? a(b, c) : a
            }), d
        }, autostart: function (a, b, c) {
            if (!this.isTransiting && (this.args = _g.transitionargs[a], this.currentItem = $(this.opts.containment).find("." + this.opts.currentClass), this.stashitemClass(), "x" == b && (this.activeItem = $(this.opts.containment).find(0 > c ? "." + this.opts.rightClass : "." + this.opts.leftClass)), "y" == b && (this.activeItem = $(this.opts.containment).find(0 > c ? "." + this.opts.downClass : "." + this.opts.upClass)), this.activeItem.length)) {
                this.args.currentTop && this.currentItem.addClass(this.opts.topClass), this.plus = c, this.direction = b, this.args.perspective ? $(this.opts.containment).addClass(this.opts.perspectiveClass) : $(this.opts.containment).removeClass(this.opts.perspectiveClass);
                var d = {gesture: {}};
                "x" == b ? d.gesture.deltaX = 0 : d.gesture.deltaY = 0, this.dragHandle(0), this.dragEnd(d)
            }
        }, enableTimer: function () {
            this.timerDisabled = !1
        }, disableTimer: function () {
            this.timerDisabled = !0
        }, setCurrent: function (a, b) {
            var c, d = this;
            $(this.opts.containment).children("." + this.opts.itemClass).removeClass(this.opts.topClass).removeClass(this.opts.activeClass).removeClass(this.opts.upClass).removeClass(this.opts.rightClass).removeClass(this.opts.leftClass).removeClass(this.opts.downClass);
            var e = $(this.opts.containment).children().length;
            if (a >= e) {
                if (!this.opts.repeat)return void this.timerStop();
                this.current = 0, a = 0
            } else if (0 > a) {
                if (!this.opts.repeat)return void this.timerStop();
                this.current = e - 1, a = e - 1
            }
            if ($(this.opts.containment).children().each(function () {
                    $(this).index() == a ? (c = $(this), $(this).addClass(d.opts.currentClass)) : $(this).removeClass(d.opts.currentClass)
                }), b && c) {
                if ("x" == b)var f = this.opts.leftClass, g = this.opts.rightClass; else var f = this.opts.upClass, g = this.opts.downClass;
                c.prev().length ? c.prev().addClass(f) : this.opts.repeat && $(this.opts.containment).children().last().addClass(f), c.next().length ? c.next().addClass(g) : this.opts.repeat && $(this.opts.containment).children().first().addClass(g)
            }
        }, timerStart: function (a) {
            if (!this.timerDisabled) {
                var b = this;
                if (a)a.type || (a.type = b.opts.type), a.axis || (a.axis = "x"), a.diretion || (a.direction = -1), a.startAt || (a.startAt = 0), this.setCurrent(a.startAt, a.axis), this.current = a.startAt, this.TimerArgs = a; else {
                    if (!this.TimerArgs)return;
                    a = this.TimerArgs, this.TimerDirection = this.TimerDirection || b.opts.autoplayDirection, this.current = null != this.tempCurrent ? this.tempCurrent : -1 == this.TimerDirection ? this.current + 1 : this.current - 1, this.tempCurrent = null, this.TimerDirection = null, this.setCurrent(this.current, a.axis)
                }
                this.Timer && window.clearTimeout(this.Timer), this.Timer = window.setTimeout(function () {
                    b.autostart(a.type, a.axis, a.direction)
                }, this.opts.interval)
            }
        }, timerStop: function () {
            this.Timer && (window.clearTimeout(this.Timer), this.Timer = null), this.TimerArgs = null, this.disableTimer()
        }
    }, "undefined" == typeof require ? (window._g || (window._g = {}), window._g.transition = a) : define(["_g/base", "jquery.transit", "_g/transitionargs"], function () {
        return window._g.transition = a, window._g.transition
    })
}(window), function () {
    var a = {
        0: {
            x: {
                activeItem: {
                    x: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {
                    x: function (a, b) {
                        return a * b * 100 + "%"
                    }
                }
            }, y: {
                activeItem: {
                    y: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {
                    y: function (a, b) {
                        return a * b * 100 + "%"
                    }
                }
            }, perspective: !1, currentEasing: "snap", activeEasing: "snap"
        },
        1: {
            x: {
                activeItem: {
                    x: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {x: 0}
            }, y: {
                activeItem: {
                    y: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {y: 0}
            }, activeTop: !0, perspective: !1, currentEasing: "snap", activeEasing: "snap"
        },
        2: {
            x: {
                activeItem: {}, currentItem: {
                    opacity: function (a, b) {
                        return 1 - b
                    }
                }
            }, y: {
                activeItem: {}, currentItem: {
                    opacity: function (a, b) {
                        return 1 - b
                    }
                }
            }, currentTop: !0, perspective: !1, currentEasing: "snap", activeEasing: "snap"
        },
        3: {
            perspective: !0,
            currentEasing: "out",
            activeEasing: "in",
            currentTop: !0,
            percentcontrol: [.5, 1],
            .5: {
                x: {
                    activeItem: {
                        rotateY: function (a) {
                            return 90 * -a + "deg"
                        }, opacity: .2
                    }, currentItem: {
                        rotateY: function (a, b) {
                            return 90 * a * b * 2 + "deg"
                        }, opacity: function (a, b) {
                            return .2 + .8 * (1 - 2 * b)
                        }
                    }
                }, y: {
                    activeItem: {
                        rotateX: function (a) {
                            return 90 * a + "deg"
                        }, opacity: .2
                    }, currentItem: {
                        rotateX: function (a, b) {
                            return 90 * -a * b * 2 + "deg"
                        }, opacity: function (a, b) {
                            return .2 + .8 * (1 - 2 * b)
                        }
                    }
                }
            },
            1: {
                x: {
                    activeItem: {
                        rotateY: function (a, b) {
                            return 90 * -a * (1 - 2 * (b - .5)) + "deg"
                        }, opacity: function (a, b) {
                            return .2 + .8 * (b - .5) * 2
                        }
                    }, currentItem: {
                        rotateY: function (a) {
                            return 90 * a + "deg"
                        }, opacity: .2
                    }
                }, y: {
                    activeItem: {
                        rotateX: function (a, b) {
                            return 90 * a * (1 - 2 * (b - .5)) + "deg"
                        }, opacity: function (a, b) {
                            return .2 + .8 * (b - .5) * 2
                        }
                    }, currentItem: {
                        rotateX: function (a) {
                            return 90 * -a + "deg"
                        }, opacity: .2
                    }
                }
            }
        },
        4: {
            x: {
                css: {
                    currentItem: {
                        transformOrigin: function (a) {
                            return 0 > a ? "100% 50%" : "0% 50%"
                        }
                    }, activeItem: {
                        transformOrigin: function (a) {
                            return a > 0 ? "100% 50%" : "0% 50%"
                        }
                    }
                }, activeItem: {
                    x: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }, opacity: function (a, b) {
                        return b
                    }, rotateY: function (a, b) {
                        return -a * (1 - b) * 90 + "deg"
                    }
                }, currentItem: {
                    x: function (a, b) {
                        return a * b * 100 + "%"
                    }, rotateY: function (a, b) {
                        return a * b * 90 + "deg"
                    }, opacity: function (a, b) {
                        return 1 - b
                    }
                }
            }, y: {
                css: {
                    currentItem: {
                        transformOrigin: function (a) {
                            return 0 > a ? "50% 100%" : "50% 0%"
                        }
                    }, activeItem: {
                        transformOrigin: function (a) {
                            return a > 0 ? "50% 100%" : "50% 0%"
                        }
                    }
                }, activeItem: {
                    y: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }, opacity: function (a, b) {
                        return b
                    }, rotateX: function (a, b) {
                        return a * (1 - b) * 90 + "deg"
                    }
                }, currentItem: {
                    y: function (a, b) {
                        return a * b * 100 + "%"
                    }, rotateX: function (a, b) {
                        return -a * b * 90 + "deg"
                    }, opacity: function (a, b) {
                        return 1 - b
                    }
                }
            }, currentTop: !0, perspective: !0, currentEasing: "easeOutCubic", activeEasing: "easeOutCubic"
        },
        5: {
            x: {
                css: {
                    currentItem: {
                        transformOrigin: function (a) {
                            return a > 0 ? "100% 50%" : "0% 50%"
                        }
                    }
                }, activeItem: {
                    x: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {
                    x: 0, scale: function (a, b) {
                        return .5 + .5 * (1 - b)
                    }
                }
            }, y: {
                css: {
                    currentItem: {
                        transformOrigin: function (a) {
                            return a > 0 ? "50% 100%" : "50% 0%"
                        }
                    }
                }, activeItem: {
                    y: function (a, b) {
                        return -a * (1 - b) * 100 + "%"
                    }
                }, currentItem: {
                    y: 0, scale: function (a, b) {
                        return .5 + .5 * (1 - b)
                    }
                }
            }, activeTop: !0, perspective: !1, currentEasing: "epubOut", activeEasing: "epubOut"
        }
    };
    "undefined" == typeof require ? (window._g || (window._g = {}), window._g.transitionargs = a) : define(["_g/base"], function () {
        return window._g.transitionargs = a, window._g.transitionargs
    })
}(window), function () {
    var a = {
        init: function () {
            var a = {
                model: function (a, b) {
                    return new coolsite_play.model.action.action(a, b)
                }
            };
            coolsite_play.collection.action = _g.mvc.createCollection(a);
            var b = {
                model: function (a, b) {
                    return new coolsite_play.model.animation.animation(a, b)
                }
            };
            coolsite_play.collection.animation = _g.mvc.createCollection(b);
            var c = {enableSync: !1};
            coolsite_play.collection.element = _g.mvc.createCollection(c), coolsite_play.collection.slider = coolsite_play.collection.element.extend({
                model: function (a, b) {
                    return new coolsite_play.model.element.slider(a, b)
                }, generate: function () {
                    var a = this;
                    this.reset([], {silent: !0}), $(document).find(".c-slider").each(function () {
                        var b = a.getArgs(this);
                        a.add({args: b}), a.last().iview.setElement(this), a.last().iview.afterRender()
                    })
                }, getArgs: function (a) {
                    var b = $(a).attr("data-c_slider_args"), b = b.split(";"), c = {};
                    return _.each(b, function (a) {
                        var b = a.split(":");
                        c[b[0]] = b[1]
                    }), c
                }, stop: function () {
                    this.each(function (a) {
                        a.stop()
                    })
                }
            });
            var d = {
                model: function (a, b) {
                    return new coolsite_play.model.timeline.timeline(a, b)
                }
            };
            coolsite_play.collection.timeline = _g.mvc.createCollection(d), _cs.mvc.init_controllers(), _cs.mvc.init_views(), _cs.mvc.init_models(), coolsite_play.animationlist = new coolsite_play.collection.animation, coolsite_play.timelinelist = new coolsite_play.collection.timeline, coolsite_play.sliderlist = new coolsite_play.collection.slider, coolsite_play.actionlist = new coolsite_play.collection.action
        }, init_models: function () {
            var a = {
                enableSync: !1, autoIndex: !0, element: null, bindRemove: function () {
                }, callback: function () {
                    this.type = this.get("data").type, this.exec = this.get("data").exec
                }, initView: coolsite_play.view.action.action, getArgs: function () {
                    var a = this.get("data").args;
                    return $.extend(!0, {}, a)
                }, getType: function () {
                    var a = this.get("data").type;
                    return a
                }
            };
            coolsite_play.model.action.action = _g.mvc.createModel(a);
            var b = {
                enableSync: !1, autoIndex: !0, element: null, bindRemove: function () {
                }, callback: function () {
                }, initView: coolsite_play.view.animation.animation
            };
            coolsite_play.model.animation.animation = _g.mvc.createModel(b);
            var c = {
                enableSync: !1,
                autoIndex: !0,
                initView: coolsite_play.view.element.element,
                callback: function () {
                }
            };
            coolsite_play.model.element.element = _g.mvc.createModel(c), coolsite_play.model.element.slider = coolsite_play.model.element.element.extend({
                initView: coolsite_play.view.element.slider,
                start: function () {
                    var a = this, b = this.get("args");
                    if (this.transition = transition = this.getTransition(), !this.silderStart) {
                        if (this.sliderStart = !0, this.iview.$el.children(".c-leftarrow").on("click", function () {
                                a.switchSlide("prev")
                            }), this.iview.$el.children(".c-rightarrow").on("click", function () {
                                a.switchSlide("next")
                            }), coolsite_play.isPreview || _.each(this.iview.slidernavdots, function (b, c) {
                                $(b).on("click", function () {
                                    a.switchSlide(c)
                                })
                            }), this.iview.$el.children(".c-slider-mask").data("sliderId", this.id), !Number(b.ap))return;
                        transition.enableTimer(), transition.timerStart({})
                    }
                },
                stop: function () {
                    this.sliderStart && (this.transition.timerStop(), this.iview.$el.children(".c-leftarrow").off("click"), this.iview.$el.children(".c-rightarrow").off("click"), coolsite_play.isPreview || this.iview.slidernavdots.off("click"), this.sliderStart = !1)
                },
                switchSlide: function (a) {
                    if (!this.transition || !this.transition.isTransiting) {
                        var b = this.get("args");
                        if ("prev" == a && (this.transition.TimerDirection = 1, this.transition.autostart(b.type, "x", 1)), "next" == a && this.transition.autostart(b.type, "x", -1), _.isNumber(a)) {
                            if (a == this.transition.currentIndex)return null;
                            direction = a > this.transition.currentIndex ? -1 : 1, this.transition.currentIndex = a, this.transition.prepareNextClass(this.iview.slidermask, a, direction), this.transition.TimerDirection = direction, this.transition.Timer && window.clearTimeout(this.transition.Timer), this.transition.tempCurrent = a, this.transition.autostart(b.type, "x", direction), this.transition.TimerDirection = -1
                        }
                    }
                },
                onChangeTo: function (a, b) {
                    (coolsite_play.isPreview || coolsite_play.isPlay) && (_.isNumber(a) && this.iview.slides.eq(a).trigger("recover"), this.iview.slides.eq(b).trigger("changeTo"))
                },
                getTransition: function () {
                    if (this.transition)return this.transition;
                    var a = this.iview.$el.attr("data-c_sliderid"), b = coolsite_editor.elementlist.get(a);
                    return b.transition
                }
            });
            var d = {
                enableSync: !1, autoIndex: !0, element: null, bindRemove: function () {
                }, callback: function () {
                }, initView: coolsite_play.view.timeline.timeline, play: function () {
                    var a = this.getArgs();
                    a && 2 == a.st && this.played || (this.played = !0, this.animations || (this.animations = this.get("animations"), this.animations && this.animations.length && (this.animations = _.map(this.animations, function (a) {
                        var b = coolsite_play.animationlist.get(a);
                        return b ? b : null
                    }), this.animations = _.reject(this.animations, function (a) {
                        return !a
                    }), this.animations = _.reject(this.animations, function (a) {
                        return a.toJSON().data.t.wa
                    }))), this.timeline || (this.timeline = coolsite_play.util.timeline.createTimeline({
                        animations: this.animations,
                        args: a,
                        model: this
                    })), this.timeline.play(0))
                }, stop: function () {
                    this.timeline && this.timeline.kill()
                }, recoverStyle: function () {
                    var a = this.getArgs();
                    a && 2 == a.st && this.played || this.animations && _.each(this.animations, function (a) {
                        a.iview.recoverStyle()
                    })
                }, getArgs: function () {
                    var a = this.get("data");
                    return a.t
                }
            };
            coolsite_play.model.timeline.timeline = _g.mvc.createModel(d)
        }, init_views: function () {
            coolsite_play.view.action.action = {
                autoRender: !1,
                events: coolsite_play.controller.action.action,
                execute: function (a) {
                    var b = this.model.getArgs();
                    if (b && 2 == b.st && this.model.triggered)return !1;
                    this.model.triggered = !0;
                    var c = this.model.get("data").exec;
                    switch (c) {
                        case 0:
                            this.renderAnimations();
                            break;
                        case 1:
                            this.renderShow();
                            break;
                        case 2:
                            this.renderHide();
                            break;
                        case 5:
                            this.renderUrl();
                            break;
                        case 6:
                            this.renderSwitch();
                            break;
                        case 10:
                            this.renderUrl();
                            break;
                        case 16:
                            this.renderPhone();
                            break;
                        case 30:
                            this.renderHash();
                            break;
                        case 20:
                            this.renderToggle();
                            break;
                        case 21:
                            this.renderClass("add");
                            break;
                        case 22:
                            this.renderClass("remove");
                            break;
                        case 23:
                            this.renderClass("toggle");
                            break;
                        case 26:
                            this.renderState();
                            break;
                        case 27:
                            this.renderDialog("open", a);
                            break;
                        case 28:
                            this.renderDialog("close", a);
                            break;
                        case 29:
                            this.renderDialog("toggle", a);
                            break;
                        case 32:
                            this.renderHtml("load");
                            break;
                        case 33:
                            this.renderHtml("unload");
                            break;
                        case 52:
                            this.renderMedia("play");
                            break;
                        case 53:
                            this.renderMedia("pause");
                            break;
                        case 54:
                            this.renderMedia("stop");
                            break;
                        case 55:
                            this.renderMedia("toggle")
                    }
                },
                renderAnimations: function () {
                    var a = this.model.getArgs();
                    this.animations || (this.animations = a.a_ids, this.animations && this.animations.length && (this.animations = _.map(this.animations, function (a) {
                        var b = coolsite_play.animationlist.get(a);
                        return b ? b : null
                    }), this.animations = _.reject(this.animations, function (a) {
                        return !a
                    }))), this.timeline || (this.timeline = coolsite_play.util.timeline.createTimeline({
                        animations: this.animations,
                        args: a
                    })), this.timeline.play(0)
                },
                getEl: function (a) {
                    var b = $("[data-c_e_id=" + a + "]");
                    return b = b.length > 1 && void 0 != this.model.siblingIndex && b[this.model.siblingIndex] ? $(b[this.model.siblingIndex]) : b
                },
                renderShow: function () {
                    var a = this, b = this.model.getArgs(), c = b.e_ids;
                    _.each(c, function (b) {
                        var c = a.getEl(b);
                        c.length && (c.removeClass("c-initHide"), c.removeClass("cf-initHide"), c.show())
                    })
                },
                renderHide: function () {
                    var a = this, b = this.model.getArgs(), c = b.e_ids;
                    _.each(c, function (b) {
                        var c = a.getEl(b);
                        c.length && c.hide()
                    })
                },
                renderToggle: function () {
                    var a = this, b = this.model.getArgs(), c = b.e_ids;
                    _.each(c, function (b) {
                        var c = a.getEl(b);
                        c.length && (c.hasClass("c-initHide") || c.hasClass("cf-initHide") ? (c.removeClass("c-initHide"), c.removeClass("cf-initHide"), c.show()) : c.toggle())
                    })
                },
                renderClass: function (a, b) {
                    var c = this, d = this.model.getArgs();
                    b || (b = d.cla);
                    var e = d.e_ids;
                    b && _.each(e, function (d) {
                        var e = c.getEl(d);
                        e.length && ("add" == a && e.addClass(b), "remove" == a && e.removeClass(b), "toggle" == a && e.toggleClass(b))
                    })
                },
                renderDialog: function (a, b) {
                    var c = this, d = this.model.getArgs(), e = d.e_ids;
                    _.each(e, function (d) {
                        var e = c.getEl(d);
                        if (e.length) {
                            var f = $(b.target).closest("[data-c_contentview_id]");
                            if (f.length) {
                                var g = f.attr("data-c_contentview_id");
                                if (e.find("[data-c_e_id=" + g + "]").length) {
                                    var h = f.attr("data-c_content_url");
                                    if (h) {
                                        e.find("[data-c_e_id=" + g + "]").empty();
                                        {
                                            $.ajax({
                                                url: h, type: "GET", dataType: "html", success: function (a) {
                                                    e && e.find("[data-c_e_id=" + g + "]").length && e.find("[data-c_e_id=" + g + "]").replaceWith(a)
                                                }, error: function () {
                                                }, timeout: 1e4
                                            })
                                        }
                                    }
                                }
                            }
                            "open" == a ? (e.removeClass("c-initHide"), e.removeClass("cf-initHide"), e.show(), window.setTimeout(function () {
                                e.addClass("c-dialog-open")
                            }, 300)) : "close" == a ? (e.removeClass("c-dialog-open"), window.setTimeout(function () {
                                e.hide()
                            }, 300)) : "toggle" == a && (e.hasClass("c-dialog-open") ? (e.removeClass("c-dialog-open"), window.setTimeout(function () {
                                e.hide()
                            }, 300)) : (e.removeClass("c-initHide"), e.removeClass("cf-initHide"), e.show(), window.setTimeout(function () {
                                e.addClass("c-dialog-open")
                            }, 300)))
                        }
                    })
                },
                renderMedia: function (a) {
                    var b = this.model.getArgs(), c = b.e_ids;
                    _.each(c, function (b) {
                        switch (a) {
                            case"play":
                                _g.html5media.play(b);
                                break;
                            case"pause":
                                _g.html5media.pause(b);
                                break;
                            case"stop":
                                _g.html5media.stop(b);
                                break;
                            case"toggle":
                                _g.html5media.toggle(b)
                        }
                    })
                },
                renderState: function (a) {
                    var b = this, c = this.model.getArgs();
                    a || (a = c.cla);
                    var d = c.e_ids;
                    _.each(d, function (c) {
                        var d = b.getEl(c);
                        if (d.length) {
                            if ("c-state1" != a && d.removeClass("c-state1"), "c-state2" != a && d.removeClass("c-state2"), "c-state3" != a && d.removeClass("c-state3"), !a)return;
                            d.addClass(a)
                        }
                    })
                },
                renderUrl: function () {
                    var a = this.model.getArgs();
                    if (a.url) {
                        var b = this.model.get("data").exec;
                        if (10 == b ? 0 == a.url.indexOf("#") || -1 != a.url.indexOf("://") || (a.url = "http://" + a.url) : 5 == b && "undefined" != typeof portal_url && (a.url = portal_url + a.url), a.blank) {
                            if (coolsite_play.isPreview)return coolsite_editor.ui.message.show("warning", coolsite_editor.WARN[100]), !1;
                            window.open(a.url)
                        } else {
                            if (coolsite_play.isPreview)return coolsite_editor.ui.message.show("warning", coolsite_editor.WARN[100]), !1;
                            window.location.href = a.url
                        }
                    }
                },
                renderHash: function () {
                    var a = this.model.getArgs();
                    a.url && coolsite_play.events.scroll.doHashScroll(null, a.url)
                },
                renderPhone: function () {
                    var a = this.model.getArgs();
                    a.url && (window.location = "tel:" + a.url)
                },
                renderHtml: function (a) {
                    var b = this, c = this.model.getArgs(), d = c.e_ids;
                    _.each(d, function (c) {
                        var d = b.getEl(c);
                        d.length && ("load" == a ? (d.removeClass("c-initHide"), d.removeClass("cf-initHide"), d.show(), d.attr("data-src") && d.attr("src", d.attr("data-src")), d.attr("data-srcdoc") && (_g.device.msie() ? d[0].contentWindow.document.write(d.attr("data-srcdoc")) : d.attr("srcdoc", d.attr("data-srcdoc")))) : "unload" == a && (d.attr("src") && d.removeAttr("src"), d.attr("srcdoc") && (_g.device.msie() ? d[0].contentWindow.document.write("") : d.removeAttr("srcdoc"))))
                    })
                },
                renderSwitch: function () {
                    var a = this, b = this.model.getArgs(), c = b.e_ids;
                    _.each(c, function (c) {
                        var d = a.getEl(c);
                        d.length && d.trigger("switchTo", b.i)
                    })
                }
            }, coolsite_play.view.animation.animation = {
                autoRender: !1,
                events: coolsite_play.controller.animation.animation,
                stashStyle: function () {
                    this.tmpClass = this.$el.attr("class"), this.tmpStyle = this.$el.attr("style")
                },
                recoverStyle: function () {
                    this.$el.attr("class", this.tmpClass), this.$el.attr("style", this.tmpStyle)
                }
            }, coolsite_play.view.element.element = {
                autoRender: !1,
                events: coolsite_play.controller.element.element
            }, coolsite_play.view.element.slider = $.extend(!0, {}, coolsite_play.view.element.element, {
                events: coolsite_play.controller.element.slider,
                afterRender: function () {
                    this.slidernav = this.$el.children(".c-slider-nav"), this.slidernavdots = this.slidernav.children(".c-slider-nav-dot"), this.slidermask = this.$el.children(".c-slider-mask"), this.slides = this.slidermask.children(".c-slide");
                    var a = this.model.get("args");
                    coolsite_play.isPreview || (this.model.transition = coolsite_play.slider(this.slidermask, a), this.model.transition.refreshSlideClass(this.slidermask, 0), this.slidernavdots.first().addClass("c-active"), this.model.transition.currentIndex = 0)
                }
            }), coolsite_play.view.timeline.timeline = {
                autoRender: !1,
                events: coolsite_play.controller.timeline.timeline
            }
        }, init_controllers: function () {
            coolsite_play.controller.action.action = {
                c_start: function (a) {
                    return $(a.target).is(this.$el) && 6 == this.model.type ? (this.execute(a), !1) : void 0
                }, click: function (a) {
                    return 0 == this.model.type ? (this.execute(a), !1) : void 0
                }, dblclick: function (a) {
                    return 4 == this.model.type ? (this.execute(a), !1) : void 0
                }, mouseover: function (a) {
                    return 20 == this.model.type ? (this.execute(a), !1) : void 0
                }, mouseout: function (a) {
                    return 21 == this.model.type ? (this.execute(a), !1) : void 0
                }, c_scroll: function (a) {
                    23 == this.model.type && this.execute(a)
                }, c_scrollUp: function (a) {
                    $(a.target).is(this.$el) && 24 == this.model.type && this.execute(a)
                }, c_scrollDown: function (a) {
                    $(a.target).is(this.$el) && 25 == this.model.type && this.execute(a)
                }, scrollIn: function (a) {
                    $(a.target).is(this.$el) && 26 == this.model.type && this.execute(a)
                }, scrollUpIn: function (a) {
                    $(a.target).is(this.$el) && 27 == this.model.type && this.execute(a)
                }, scrollDownIn: function (a) {
                    $(a.target).is(this.$el) && 28 == this.model.type && this.execute(a)
                }, scrollOut: function (a) {
                    $(a.target).is(this.$el) && 29 == this.model.type && this.execute(a)
                }, scrollUpOut: function (a) {
                    $(a.target).is(this.$el) && 30 == this.model.type && this.execute(a)
                }, scrollDownOut: function (a) {
                    $(a.target).is(this.$el) && 31 == this.model.type && this.execute(a)
                }, changeTo: function (a) {
                    $(a.target).is(this.$el) && 5 == this.model.type && this.execute(a)
                }, c_active: function (a) {
                    $(a.target).is(this.$el) && 33 == this.model.type && this.execute(a)
                }, c_deactive: function (a) {
                    $(a.target).is(this.$el) && 34 == this.model.type && this.execute(a)
                }
            }, coolsite_play.controller.animation.animation = {}, coolsite_play.controller.element.element = {
                scrollUpIn: function () {
                }
            }, coolsite_play.controller.element.slider = $.extend(!0, {}, coolsite_play.controller.element.element, {
                scrollUpIn: function (a) {
                    $(a.target).is(this.$el) && (this.model.start(), this.model.onChangeTo(null, 0))
                }, switchTo: function (a, b) {
                    $(a.target).is(this.$el) && this.model.switchSlide(b)
                }
            }), coolsite_play.controller.timeline.timeline = {
                scrollIn: function (a) {
                    $(a.target).is(this.$el) && this.model.play()
                }, recover: function (a) {
                    $(a.target).is(this.$el) && this.model.recoverStyle()
                }, changeTo: function (a) {
                    $(a.target).is(this.$el) && this.model.play()
                }, c_active: function (a) {
                    !$(a.target).is(this.$el)
                }, c_deactive: function (a) {
                    !$(a.target).is(this.$el)
                }, t_start: function (a) {
                    $(a.target).is(this.$el) && (coolsite_play.isSectionLock = "locked" == this.$el.attr("data-c_tl_locked") ? this.model.id : !1)
                }, t_end: function (a) {
                    $(a.target).is(this.$el) && coolsite_play.isSectionLock == this.model.id && (coolsite_play.isSectionLock = !1)
                }
            }
        }
    };
    "undefined" == typeof require ? (window._cs || (window._cs = {}), window._cs.mvc = a) : define([], function () {
        return window._cs || (window._cs = {}), window._cs.mvc = a, window._cs.mvc
    })
}(window), function () {
    var a = {
        init: function () {
            coolsite_play.events.dialog = {
                init: function () {
                    $(document).find(".c-modal").on("click", ".dialog-close", coolsite_play.events.dialog.handleDialogClose)
                }, handleDialogClose: function () {
                    var a = $(this).closest(".c-modal");
                    return a.removeClass("c-dialog-open"), window.setTimeout(function () {
                        a.hide()
                    }, 300), !1
                }, stop: function () {
                    $(document).find(".c-modal").off("click", ".dialog-close", coolsite_play.events.dialog.handleDialogClose)
                }
            }, coolsite_play.events.form = {
                init: function () {
                    $("form textarea").each(function () {
                        "    " == $(this).html() && $(this).html("")
                    }), $("[data-c_form]").each(function () {
                        $(this).bind("submit", coolsite_play.events.form.bind)
                    })
                }, bind: function () {
                    var a = $(this), b = $(this).attr("data-action");
                    if (!b)return !1;
                    $.ajax({
                        url: b, type: "POST", dataType: "JSON", data: $(this).serialize(), beforeSend: function (a) {
                            a.setRequestHeader("X-CSRFToken", coolsite_play.readCookie("csrftoken"))
                        }, traditional: !0, success: function (b) {
                            if (a.find(".c-error").removeClass("c-error"), 200 == b.code)a.addClass("c-success"), a.removeClass("c-error"), coolsite_play.events.form.handleRedirect(a); else {
                                a.addClass("c-error");
                                var c = b.msg;
                                _.each(c, function (b, c) {
                                    var d = a.find("[name=" + c + "]");
                                    d.is("input[type=radio]") || d.is("input[type=checkbox]") ? d.parent().addClass("c-error") : a.find("[name=" + c + "]").addClass("c-error")
                                })
                            }
                        }, error: function () {
                        }, timeout: 1e4
                    });
                    return !1
                }, stop: function () {
                    $("[data-c_form]").each(function () {
                        $(this).unbind("submit", coolsite_play.events.form.bind)
                    })
                }, handleRedirect: function (a) {
                    var b, c = a.attr("data-url"), d = a.attr("data-page"), e = a.attr("data-target");
                    if (c)b = c, 0 == b.indexOf("#") || -1 != b.indexOf("://") || (b = "http://" + b); else {
                        if (!d)return !1;
                        b = d, "undefined" != typeof portal_url && (b = portal_url + b)
                    }
                    if (e) {
                        if (coolsite_play.isPreview)return coolsite_editor.ui.message.show("warning", coolsite_editor.WARN[100]), !1;
                        window.open(b)
                    } else {
                        if (coolsite_play.isPreview)return coolsite_editor.ui.message.show("warning", coolsite_editor.WARN[100]), !1;
                        window.location.href = b
                    }
                }
            }, coolsite_play.events.html = {
                init: function () {
                    _g.device.msie() && $(document).find("iframe.c-iframe").each(function () {
                        if ($(this).attr("srcdoc")) {
                            var a = $(this).attr("srcdoc");
                            this.contentWindow.document.write(a)
                        }
                    })
                }
            }, coolsite_play.events.mousewheel = {
                init: function () {
                    $("body").find(".c-section-switch").each(function () {
                        $(this).on("mousewheel", coolsite_play.events.mousewheel.handlemousewheel)
                    })
                }, stop: function () {
                    $("body").find(".c-section-switch").each(function () {
                        $(this).off("mousewheel", coolsite_play.events.mousewheel.handlemousewheel)
                    })
                }, handlemousewheel: function (a) {
                    var b = a.currentTarget, c = null;
                    (a.deltaY < -10 || coolsite_play.isWindows && a.deltaY < 0) && (c = 1), (a.deltaY > 10 || coolsite_play.isWindows && a.deltaY > 0) && (c = 0), null != c && coolsite_play.events.scroll.doSectionSwitch(b, c), a.preventDefault()
                }
            }, coolsite_play.events.scroll = {
                init: function () {
                    coolsite_play.events.scroll.refresh(), $("body").trigger("scrollIn"), $("body").trigger("scrollUpIn");
                    var a = $(window).scrollTop(), b = coolsite_play.events.scroll.getScrollHeight(), c = b - $(window).height(), d = coolsite_play.sectionItems;
                    if ($("body").find(".c-section,.c-slider").each(function () {
                            $(this).offset().top < a + $(window).height() && ($(this).addClass("c-scrollIn"), $(this).trigger("scrollIn"), $(this).trigger("scrollUpIn"))
                        }), d.length)if (a >= c)coolsite_play.events.scroll.activate(d.length - 1); else if (a <= d[0].top)coolsite_play.events.scroll.activate(0); else for (i = 0; i < d.length; i++)a >= d[i].top && (!d[i + 1] || a <= d[i + 1].top) && coolsite_play.events.scroll.activate(i);
                    coolsite_play.events.scroll.lastst = a, coolsite_play.scroll_offset = 0, $(window).bind("scroll", coolsite_play.events.scroll.handle), $(window).bind("resize", coolsite_play.events.scroll.resizehandle)
                }, refresh: function () {
                    coolsite_play.scrollItems = [], coolsite_play.sectionItems = [];
                    var a = $("body").find(".c-section,.c-slider");
                    a.map(function () {
                        {
                            var a = $(this).offset().top, b = $(this).offset().top + $(this).height();
                            $(this).hasClass("c-section") ? "section" : $(this).hasClass("c-slider") ? "slider" : "other"
                        }
                        return {top: a, bottom: b, target: this}
                    }).sort(function (a, b) {
                        return a.top - b.top
                    }).each(function () {
                        coolsite_play.scrollItems.push(this), $(this.target).hasClass("c-section") && "scroll" == $(this.target).attr("data-c_spy") && coolsite_play.sectionItems.push(this)
                    }), coolsite_play.scrollHeight = coolsite_play.events.scroll.getScrollHeight()
                }, getScrollHeight: function () {
                    return Math.max($("body")[0].scrollHeight, document.documentElement.scrollHeight)
                }, handle: function () {
                    var a, b, c = $(this).scrollTop(), d = coolsite_play.events.scroll.getScrollHeight(), e = d - $(window).height(), f = coolsite_play.scrollItems, g = coolsite_play.sectionItems;
                    if (coolsite_play.scrollHeight != d && coolsite_play.events.scroll.refresh(), a = c > coolsite_play.events.scroll.lastst ? 1 : 0, coolsite_play.events.scroll.lastst = c, $("body").trigger("c_scroll"), $("body").trigger(1 == a ? "c_scrollUp" : "c_scrollDown"), g.length)if (c >= e)coolsite_play.events.scroll.activate(g.length - 1); else if (c <= g[0].top)coolsite_play.events.scroll.activate(0); else for (b = 0; b < g.length; b++)a ? c >= g[b].top && (!g[b + 1] || c <= g[b + 1].top) && coolsite_play.events.scroll.activate(b) : c <= g[b].top && (!g[b - 1] || c >= g[b - 1].top) && coolsite_play.events.scroll.activate(b - 1);
                    for (b = 0; b < f.length; b++) {
                        var h = f[b].target, i = f[b].top, j = f[b].bottom;
                        a ? i < c + $(window).height() && j - c > 0 ? $(h).hasClass("c-scrollIn") ? ($(h).trigger("c_scroll"), $(h).trigger("c_scrollUp")) : ($(h).addClass("c-scrollIn"), $(h).trigger("scrollIn"), $(h).trigger("scrollUpIn")) : $(h).hasClass("c-scrollIn") && ($(h).removeClass("c-scrollIn"), $(h).trigger("scrollOut"), $(h).trigger("scrollUpOut"), $(h).trigger("recover")) : j - c > 0 && i < c + $(window).height() ? $(h).hasClass("c-scrollIn") ? ($(h).trigger("c_scroll"), $(h).trigger("c_scrollDown")) : ($(h).addClass("c-scrollIn"), $(h).trigger("scrollIn"), $(h).trigger("scrollDownIn")) : $(h).hasClass("c-scrollIn") && ($(h).removeClass("c-scrollIn"), $(h).trigger("scrollOut"), $(h).trigger("scrollDownOut"), $(h).trigger("recover"))
                    }
                }, activate: function (a) {
                    var b = coolsite_play.sectionItems;
                    if (null == coolsite_play.currentActiveIndex || coolsite_play.currentActiveIndex != a) {
                        if (null != coolsite_play.currentActiveIndex) {
                            $(b[coolsite_play.currentActiveIndex].target).trigger("c_deactive");
                            var c = b[coolsite_play.currentActiveIndex].target.id;
                            if (c) {
                                var d = $("[href=#" + c + "]");
                                d.length && d.each(function () {
                                    "scroll" == $(this).attr("data-c_spy") && $(this).parent("li").length && $(this).parent("li").removeClass("active")
                                })
                            }
                        }
                        $(b[a].target).trigger("c_active"), coolsite_play.currentActiveIndex = a;
                        var c = b[a].target.id;
                        if (c) {
                            var d = $("[href=#" + c + "]");
                            d.length && d.each(function () {
                                "scroll" == $(this).attr("data-c_spy") && $(this).parent("li").length && $(this).parent("li").addClass("active")
                            })
                        }
                    }
                }, resizehandle: function () {
                    coolsite_play.events.scroll.refresh()
                }, bindHashScroll: function () {
                    $("a[href^='#'][data-toggle!='tab']").bind("click", coolsite_play.events.scroll.doHashScroll)
                }, unBindHashScroll: function () {
                    $("a[href^='#'][data-toggle!='tab']").unbind("click", coolsite_play.events.scroll.doHashScroll)
                }, doHashScroll: function (a, b) {
                    return b || (b = $(this).attr("href")), $(b).length && $("html, body").animate({scrollTop: $(b).offset().top}, 800), !1
                }, doScrollByElement: function (a) {
                    coolsite_play.isSectionSwitching || coolsite_play.isSectionLock || $(a).length && $("html, body").animate({scrollTop: $(a).offset().top}, 800)
                }, doSectionSwitch: function (a, b) {
                    var c = $(a).prev(".c-section-switch").length ? $(a).prev(".c-section-switch") : $(a).prev(".c-section") ? $(a).prev(".c-section") : null, d = $(a).next(".c-section-switch").length ? $(a).next(".c-section-switch") : $(a).next(".c-section") ? $(a).next(".c-section") : null;
                    b && (coolsite_play.isSectionSwitching || d && (coolsite_play.events.scroll.doScrollByElement(d), coolsite_play.isSectionSwitching = a, window.setTimeout(function () {
                        coolsite_play.isSectionSwitching = null
                    }, 1e3))), b || coolsite_play.isSectionSwitching || c && (coolsite_play.events.scroll.doScrollByElement(c), coolsite_play.isSectionSwitching = a, window.setTimeout(function () {
                        coolsite_play.isSectionSwitching = null
                    }, 1e3))
                }, stop: function () {
                    $(window).unbind("scroll", coolsite_play.events.scroll.handle), $(window).unbind("resize", coolsite_play.events.scroll.resizehandle), coolsite_play.currentActiveIndex = null
                }
            }, coolsite_play.events.touch = {
                init: function () {
                    $("body").find(".c-section-switch").each(function () {
                        $(this).hammer().on("dragup", function (a) {
                            return deltaY = a.gesture.deltaY, coolsite_play.events.touch.handletouch(a, 1), a.gesture.preventDefault(), !1
                        }), $(this).hammer().on("dragdown", function (a) {
                            return deltaY = a.gesture.deltaY, coolsite_play.events.touch.handletouch(a, 0), a.gesture.preventDefault(), !1
                        })
                    });
                    var a = !1;
                    $("body").hammer().on("drag", function () {
                        if (!a) {
                            var b = _.filter(_g.html5media.medias, function (a) {
                                return "audio" == a.type && a.autoplay
                            });
                            if (b.length)try {
                                b[0].media.play(), a = !0
                            } catch (c) {
                                a = !1
                            } else a = !0
                        }
                    })
                }, handletouch: function (a, b) {
                    var c = a.currentTarget;
                    coolsite_play.events.scroll.doSectionSwitch(c, b)
                }
            }
        }
    };
    "undefined" == typeof require ? (window._cs || (window._cs = {}), window._cs.event = a) : define([], function () {
        return window._cs || (window._cs = {}), window._cs.event = a, window._cs.event
    })
}(window), function () {
    var a = {
        init: function () {
            _g.timeline = {animation: {}};
            var a = {
                param: function (a, b) {
                    var c = {repeat: b.t.rp, ease: coolsite_play.easeType[b.t.es]};
                    return c.onStartParams = ["{self}", b, a], c.onStart = this.onStart, c.onComplete = this.onComplete, c.onCompleteParams = ["{self}", b, a], c
                }, fromparam: function () {
                    var a = {};
                    return a
                }, toparam: function (a, b) {
                    var c = {};
                    return c.onComplete = this.stop, c.onCompleteParams = ["{self}", b, a], c.ease = coolsite_play.easeType[b.t.es], c.repeat = b.t.rp, c.immediateRender = !1, c.onStartParams = ["{self}", b, a], c.onStart = this.onStart, c
                }, onStart: function (b, c, d) {
                    switch (c.type) {
                        case 1:
                        case 3:
                        case 5:
                            a.show(d), a.setOriginCenter(d);
                            break;
                        case 6:
                            a.setOriginCenter(d);
                            break;
                        case 9:
                            a.setOriginCenter(d);
                            break;
                        case 10:
                            a.show(d), a.setOriginCenter(d)
                    }
                }, onComplete: function (b, c, d) {
                    switch (c.type) {
                        case 5:
                            a.unsetOriginCenter(d);
                            break;
                        case 2:
                        case 4:
                        case 6:
                            a.unsetOriginCenter(d), a.hide(d);
                            break;
                        case 7:
                            break;
                        case 9:
                        case 10:
                            a.unsetOriginCenter(d)
                    }
                }, show: function (a) {
                    $(a).removeClass("c-initHide"), $(a).removeClass("cf-initHide"), $(a).show()
                }, hide: function (a) {
                    $(a).addClass("c-initHide"), $(a).addClass("cf-initHide")
                }, setOriginCenter: function (a) {
                    $(a).css("transform-origin", "50% 50%")
                }, unsetOriginCenter: function () {
                }
            };
            _g.timeline.animation[3] = function (b, c) {
                var d = a.fromparam(b, c), e = a.toparam(b, c);
                d.css = {opacity: 0}, e.css = {opacity: 1, force3D: !1};
                var f = TweenMax.fromTo(b, c.t.du, d, e);
                return f
            }, _g.timeline.animation[4] = function (b, c) {
                var d = a.param(b, c);
                d.css = {opacity: 0, force3D: !1};
                var e = TweenMax.to(b, c.t.du, d);
                return e
            }, _g.timeline.animation[1] = function (b, c) {
                var d = c.d.di, e = c.d.dt, f = c.d.dl, g = a.fromparam(b, c), h = a.toparam(b, c), i = $(window).width(), j = $(window).height();
                g.css = {}, h.css = {force3D: !1};
                var k = !1;
                $(b).hasClass("c-initHide") && (k = !0), $(b).addClass("cf-invisible c-invisible").removeClass("c-initHide").removeClass("cf-initHide").show();
                var l = b.offset();
                switch (d) {
                    case 0:
                        g.css.y = e ? -f : -(l.top + b.height() - $(window).scrollTop()), h.css.y = 0;
                        break;
                    case 3:
                        g.css.x = e ? f : i - l.left, h.css.x = 0;
                        break;
                    case 2:
                        g.css.y = e ? f : j - (l.top - $(window).scrollTop()), h.css.y = 0;
                        break;
                    case 1:
                        g.css.x = e ? -f : -(l.left + b.width()), h.css.x = 0
                }
                e && (g.css.opacity = 0, h.css.opacity = 1), k && $(b).addClass("c-initHide").addClass("cf-initHide"), $(b).removeClass("cf-invisible c-invisible");
                var m = TweenMax.fromTo(b, c.t.du, g, h);
                return m
            }, _g.timeline.animation[2] = function (b, c) {
                var d = c.d.di, e = c.d.dt, f = c.d.dl, g = a.param(b, c), h = b.offset(), i = $(window).width(), j = $(window).height();
                switch (g.css = {force3D: !1}, d) {
                    case 0:
                        g.css.y = e ? -f : -(h.top + b.height() - $(window).scrollTop());
                        break;
                    case 3:
                        g.css.x = e ? f : i - h.left;
                        break;
                    case 2:
                        g.css.y = e ? f : j - (h.top - $(window).scrollTop());
                        break;
                    case 1:
                        g.css.x = e ? -f : -(h.left + b.width())
                }
                e && (g.css.opacity = 0);
                var k = TweenMax.to(b, c.t.du, g);
                return k
            }, _g.timeline.animation[5] = function (b, c) {
                var d = a.fromparam(b, c), e = a.toparam(b, c);
                d.css = {scale: 0}, e.css = {scale: 1, force3D: !1};
                var f = TweenMax.fromTo(b, c.t.du, d, e);
                return f
            }, _g.timeline.animation[6] = function (b, c) {
                var d = a.fromparam(b, c), e = a.toparam(b, c);
                d.css = {scale: 1}, e.css = {scale: 0, force3D: "auto"};
                var f = TweenMax.fromTo(b, c.t.du, d, e);
                return f
            }, _g.timeline.animation[8] = function (b, c) {
                var d = a.param(b, c), e = _.isNumber(c.d.op) ? Number(c.d.op) : 100;
                d.css = {opacity: e / 100, force3D: !1};
                var f = TweenMax.to(b, c.t.du, d);
                return f
            }, _g.timeline.animation[7] = function (b, c) {
                var d = a.param(b, c), e = _.isNumber(c.d.deg) ? Number(c.d.deg) : 0, f = c.d.ax || 0, g = "_cw", h = "+";
                0 > e && (g = "_ccw"), 0 > e && (h = "-");
                var i = {force3D: !1};
                0 == f && (i.rotation = h + "=" + Math.abs(e) + g), 1 == f && (i.rotationX = h + "=" + Math.abs(e) + g), 2 == f && (i.rotationY = h + "=" + Math.abs(e) + g), d.css = i, _g.device.android() && TweenLite.set(b, {transformPerspective: 2e3});
                var j = TweenMax.to(b, c.t.du, d);
                return j
            }, _g.timeline.animation[9] = function (b, c) {
                var d = a.param(b, c), e = _.isNumber(c.d.sc) ? Number(c.d.sc) : 1;
                d.css = {scale: e, force3D: !1};
                var f = TweenMax.to(b, c.t.du, d);
                return f
            }, _g.timeline.animation[10] = function (b, c) {
                var d = a.fromparam(b, c), e = a.toparam(b, c), f = _.isNumber(c.d.op) ? Number(c.d.op) : 50, g = _.isNumber(c.d.sc) ? Number(c.d.sc) : 2;
                d.css = {opacity: f / 100, scale: g}, e.css = {opacity: 1, scale: 1, force3D: !1};
                var h = TweenMax.fromTo(b, c.t.du, d, e);
                return h
            }, _g.timeline.create = function (a) {
                var b = {
                    paused: !0, onStart: function () {
                        a.model && a.model.iview && a.model.iview.$el.trigger("t_start")
                    }, onComplete: function () {
                        a.model && a.model.iview && a.model.iview.$el.trigger("t_end")
                    }, repeat: a.args ? a.args.rp : 0
                }, c = 0, d = new TimelineMax(b);
                d.addLabel("Start");
                var e = a.animations;
                return _.each(e, function (a, b) {
                    {
                        var e = a.toJSON().data, f = e.t.de, g = e.t.st;
                        e.t.rp
                    }
                    if (c += f, 2 == g)if (0 != b) {
                        var h = d.getLabelTime(b - 1 + "_start");
                        d.addLabel(b + "_start", h + f), c = h + f
                    } else d.addLabel(b + "_start", c); else d.addLabel(b + "_start", c);
                    e.d || (e.d = {});
                    var i = _g.timeline.animation[e.type](a.iview.$el, e);
                    d.add(i, c), c += e.t.du, a.siblingIds && _.each(a.siblingIds, function (a) {
                        var e = coolsite_play.animationlist.get(a);
                        if (e) {
                            {
                                var f = e.toJSON().data, g = f.t.de, h = f.t.st;
                                f.t.rp
                            }
                            if (c += g, 2 == h)if (0 != b) {
                                var i = d.getLabelTime(b - 1 + "_start");
                                d.addLabel(b + "_start", i + g), c = i + g
                            } else d.addLabel(b + "_start", c); else d.addLabel(b + "_start", c);
                            f.d || (f.d = {});
                            var j = _g.timeline.animation[f.type](e.iview.$el, f);
                            d.add(j, c), c += f.t.du
                        }
                    })
                }), d
            }
        }
    };
    "undefined" == typeof require ? (window._cs || (window._cs = {}), window._cs.sdk = a) : define([], function () {
        return window._cs || (window._cs = {}), window._cs.sdk = a, window._cs.sdk
    })
}(window), function () {
    var a = {
        init: function () {
            coolsite_play.util.action = {
                generate: function () {
                    coolsite_play.doc.find("[data-c_act_id]").each(function () {
                        var a = this, b = $(this).attr("data-c_act_id"), c = String(b).split("|");
                        for (i = 0; i < c.length; i++)coolsite_play.actionlist.each(function (b) {
                            if (b.id == c[i])if (b.hasEl) {
                                var d = $.extend(!0, {}, b.toJSON());
                                delete d.id, coolsite_play.actionlist.add(d);
                                var e = coolsite_play.actionlist.last();
                                e.iview.setElement(a), e.hasEl = !0, b.siblingIds || (b.isSibling = !0, b.siblingIndex = 0, b.siblingIds = []), 0 == b.getType() && e.iview.$el.addClass("c-action-click"), b.siblingIds.push(e.id), e.isSibling = !0, e.siblingIndex = b.siblingIds.length
                            } else b.iview.setElement(a), 0 == b.getType() && b.iview.$el.addClass("c-action-click"), b.hasEl = !0
                        })
                    })
                }
            }, coolsite_play.util.animation = {
                generate: function () {
                    coolsite_play.doc.find("[data-c_ani_id]").each(function () {
                        var a = this, b = $(this).attr("data-c_ani_id"), c = String(b).split("|");
                        for (i = 0; i < c.length; i++)coolsite_play.animationlist.each(function (b) {
                            if (b.id == c[i])if (b.hasEl) {
                                var d = $.extend(!0, {}, b.toJSON());
                                delete d.id, coolsite_play.animationlist.add(d);
                                var e = coolsite_play.animationlist.last();
                                e.iview.setElement(a), e.iview.stashStyle(), e.hasEl = !0, b.siblingIds || (b.siblingIds = []), b.siblingIds.push(e.id)
                            } else b.iview.setElement(a), b.iview.stashStyle(), b.hasEl = !0
                        })
                    })
                }
            }, coolsite_play.util.timeline = {
                generate: function () {
                    coolsite_play.doc.find("[data-c_tl_id]").each(function () {
                        var a = $(this).attr("data-c_tl_id"), b = this, c = String(a).split("|");
                        for (i = 0; i < c.length; i++)coolsite_play.timelinelist.each(function (a) {
                            a.id == c[i] && a.iview.setElement(b)
                        })
                    })
                }, createTimeline: function (a) {
                    var b = _g.timeline.create(a);
                    return b
                }, stopAll: function () {
                    coolsite_play.timelinelist.each(function (a) {
                        a.stop()
                    })
                }
            }, coolsite_play.util.video = {
                init: function () {
                    _g.html5media.collect(document, "data-c_e_id")
                }, stopAll: function () {
                    _g.html5media.stopAll()
                }
            }, coolsite_play.slider = function (a, b) {
                var c = new _g.transition({
                    containment: a,
                    disableControlled: !coolsite_play.isPreview && _g.device.mobile() ? !1 : !0,
                    duration: 500,
                    repeat: !0,
                    control: !coolsite_play.isPreview && _g.device.mobile() ? !0 : !1,
                    interval: 1e3 * Number(b.ti),
                    type: Number(b.type),
                    autoplayAxis: "x",
                    onEnd: function (b, d) {
                        c.currentIndex = d, c.refreshSlideClass(a, d), c.setNavDots(a, d), "undefined" != typeof coolsite_editor && coolsite_editor.currentSlider && coolsite_editor.currentSlider.transitionEnd && coolsite_editor.currentSlider.transitionEnd(b, d);
                        var e = $(a).data("sliderId");
                        e && ($slider = coolsite_play.sliderlist.get(e), $slider.onChangeTo(b, d))
                    }
                });
                return c.clearSlideClass = function (a) {
                    $(a).children().removeClass("c-transition-left").removeClass("c-transition-right").removeClass("c-transition-top").removeClass("c-transition-bottom")
                }, c.refreshSlideClass = function (a, b, d) {
                    d || (d = -1), c.clearSlideClass(a);
                    var e = $(a).children().length;
                    if (-1 == d)var f = "c-transition-right", g = "c-transition-left"; else var f = "c-transition-left", g = "c-transition-right";
                    $(a).children().each(function () {
                        var c = $(this).index();
                        c == b ? ($(this).addClass("c-transition-current"), $(this).prev().length ? $(this).prev().addClass(g) : e > 1 && ($(a).last().is(this) || $(a).last().addClass(g)), $(this).next().length ? $(this).next().addClass(f) : e > 1 && ($(a).first().is(this) || $(a).first().addClass(f))) : $(this).removeClass("c-transition-current")
                    })
                }, c.prepareNextClass = function (a, b, d) {
                    d || (d = -1), c.clearSlideClass(a);
                    $(a).children().length;
                    if (-1 == d)var e = "c-transition-right"; else var e = "c-transition-left";
                    $(a).children().each(function () {
                        var a = $(this).index();
                        a == b && $(this).addClass(e)
                    })
                }, c.setNavDots = function (a, b) {
                    var c = $(a).parent().children(".c-slider-nav").children(".c-slider-nav-dot");
                    c.removeClass("c-active"), c.eq(b).addClass("c-active")
                }, c
            }, coolsite_play.readCookie = function (a) {
                for (var b = a + "=", c = document.cookie.split(";"), d = 0; d < c.length; d++) {
                    for (var e = c[d]; " " == e.charAt(0);)e = e.substring(1, e.length);
                    if (0 == e.indexOf(b))return e.substring(b.length, e.length)
                }
                return null
            }, coolsite_play.play = {
                start: function () {
                    return coolsite_play.isPlay = !0, "undefined" == typeof c_data ? !1 : (c_data.timelines = c_data.timelines || [], c_data.actions = c_data.actions || [], c_data.animations = c_data.animations || [], coolsite_play.doc = $("html"), c_data.timelines.length && coolsite_play.timelinelist.reset(c_data.timelines, {silent: !0}), c_data.animations.length && coolsite_play.animationlist.reset(c_data.animations, {silent: !0}), c_data.actions.length && coolsite_play.actionlist.reset(c_data.actions, {silent: !0}), coolsite_play.sliderlist.generate(), coolsite_play.util.timeline.generate(), coolsite_play.util.animation.generate(), coolsite_play.util.action.generate(), coolsite_play.events.scroll.init(), _g.device.mobile() ? coolsite_play.events.touch.init() : coolsite_play.events.mousewheel.init(), coolsite_play.events.scroll.bindHashScroll(), coolsite_play.events.dialog.init(), coolsite_play.events.html.init(), coolsite_play.util.video.init(), coolsite_play.events.form.init(), _g.device.android() && $("body,.c-slider-mask").css({"touch-action": "initial"}), void $("body").trigger("c_start"))
                }
            }, coolsite_play.isWindows = _g.device.windows()
        }
    };
    "undefined" == typeof require ? (window._cs || (window._cs = {}), window._cs.util = a) : define([], function () {
        return window._cs || (window._cs = {}), window._cs.util = a, window._cs.util
    })
}(window), function () {
    var a = {
        init: function () {
            window.coolsite_play = {
                model: {animation: {}, action: {}, timeline: {}, element: {}, action: {}},
                view: {animation: {}, action: {}, timeline: {}, element: {}, action: {}},
                controller: {animation: {}, action: {}, timeline: {}, element: {}, action: {}},
                collection: {},
                ui: {},
                events: {},
                util: {},
                varible: {}
            }, coolsite_play.isPreview = !1, coolsite_play.scrollItems = [], coolsite_play.sectionItems = [], coolsite_play.currentActiveIndex = null, coolsite_play.isSectionSwitching = null, coolsite_play.isSectionLock = null, coolsite_play.animationCommonArgs = {
                de: 0,
                du: 1,
                rp: 0,
                rv: 0,
                st: 1,
                es: 0,
                wa: 0
            }, coolsite_play.animationArgs = {
                1: {di: 0, dt: 0, dl: 0},
                2: {di: 0, dt: 0, dl: 0},
                3: {},
                4: {},
                7: {deg: 0, ax: 0},
                8: {op: 100},
                9: {sc: 1},
                10: {sc: 2, op: 50}
            }, coolsite_play.easeType = {
                0: "Linear.easeNone",
                1: "Power0.easeIn",
                2: "Power0.easeInOut",
                3: "Power0.easeOut",
                4: "Power1.easeIn",
                5: "Power1.easeInOut",
                6: "Power1.easeOut",
                7: "Power2.easeIn",
                8: "Power2.easeInOut",
                9: "Power2.easeOut",
                10: "Power3.easeIn",
                11: "Power3.easeInOut",
                12: "Power3.easeOut",
                13: "Power4.easeIn",
                14: "Power4.easeInOut",
                15: "Power4.easeOut",
                16: "Quad.easeIn",
                17: "Quad.easeInOut",
                18: "Quad.easeOut",
                19: "Cubic.easeIn",
                20: "Cubic.easeInOut",
                21: "Cubic.easeOut",
                22: "Quart.easeIn",
                23: "Quart.easeInOut",
                24: "Quart.easeOut",
                25: "Quint.easeIn",
                26: "Quint.easeInOut",
                27: "Quint.easeOut",
                28: "Strong.easeIn",
                29: "Strong.easeInOut",
                30: "Strong.easeOut",
                31: "Back.easeIn",
                32: "Back.easeInOut",
                33: "Back.easeOut",
                34: "Bounce.easeIn",
                35: "Bounce.easeInOut",
                36: "Bounce.easeOut",
                37: "Circ.easeIn",
                38: "Circ.easeInOut",
                39: "Circ.easeOut",
                40: "Elastic.easeIn",
                41: "Elastic.easeInOut",
                42: "Elastic.easeOut",
                43: "Expo.easeIn",
                44: "Expo.easeInOut",
                45: "Expo.easeOut",
                46: "Sine.easeIn",
                47: "Sine.easeInOut",
                48: "Sine.easeOut",
                49: "SlowMo.ease"
            }, coolsite_play.elementReference = {
                "c-section": "section",
                "c-container": "container",
                "c-image": "image",
                "c-slider": "slider",
                "c-button": "button",
                "c-row": "row",
                "c-column": "column",
                "c-paragraph": "c-paragraph",
                "c-heading": "heading",
                "c-div": "div",
                "c-list": "list",
                "c-listitem": "listitem",
                "c-textblock": "textblock",
                "c-slidermask": "slidermask",
                "c-slide": "slide",
                "c-linkblock": "lineblock",
                "c-textlink": "textlink",
                "c-leftarrow": "leftarrow",
                "c-rightarrow": "rightarrow",
                "c-icon": "icon",
                "c-slidernav": "slidernav",
                "c-slidernavdot": "slidernavdot"
            }, coolsite_play.elementState = {state1: "c-state1", state2: "c-state2", state3: "c-state3"}
        }, start: function () {
            coolsite_play.animationlist = new coolsite_play.collection.animation, coolsite_play.timelinelist = new coolsite_play.collection.timeline, coolsite_play.sliderlist = new coolsite_play.collection.slider, coolsite_play.actionlist = new coolsite_play.collection.action
        }
    };
    "undefined" == typeof require ? (window._cs || (window._cs = {}), window._cs.variable = a) : define([], function () {
        return window._cs || (window._cs = {}), window._cs.variable = a, window._cs.variable
    })
}(window), function () {
    window.console && console.log || (console = {
        log: function () {
        }, debug: function () {
        }, info: function () {
        }, warn: function () {
        }, error: function () {
        }
    }), -1 == window.location.href.indexOf("-debug") && (console.log = function () {
    }, console.info = function () {
    }), "undefined" == typeof require ? (_cs.variable.init(), _cs.util.init(), _cs.event.init(), _cs.sdk.init(), _cs.mvc.init(), coolsite_play.play.start()) : require(["jquery", "bootstrap", "underscore", "backbone", "jquery.hammer", "jquery.transit", "jquery.mousewheel", "greensock/TweenMax", "_g/base", "_g/device", "_g/dragcontrol", "_g/html5media", "_g/simplemvc", "_g/transition", "_g/transitionargs", "coolsite_play/mvc/mvc", "coolsite_play/events/event", "coolsite_play/sdk/sdk", "coolsite_play/util/util", "coolsite_play/varible/variable"], function () {
        _cs.variable.init(), _cs.util.init(), _cs.event.init(), _cs.sdk.init(), _cs.mvc.init(), coolsite_play.play.start()
    })
}(window);