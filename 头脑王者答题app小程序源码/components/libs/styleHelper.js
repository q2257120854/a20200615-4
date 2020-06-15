const SizeAttrs = ['height', 'width', 'paddingTop', 'paddingRight', 'paddingBottom', 'paddingLeft', 'marginTop', 'marginRight', 'marginBottom', 'marginLeft', 'top', 'right', 'bottom', 'left', 'lineHeight', 'fontSize'];

module.exports = {
    getUnitizedValue(value) {
        if (/^\d+(\.\d+)?$/.test(value)) {
            return value + 'px';
        } else {
            return value;
        }
    },

    camelCase2Dash(str) {
        return str.replace(/([a-zA-Z])(?=[A-Z])/g, '$1-').toLowerCase();
    },

    dash2CamelCase(str) {
        return str.replace(/\-([a-z])/gi, function (m, w) {
            return w.toUpperCase();
        });
    },

    dashedSizeAttrs() {
        let that = this;
        return SizeAttrs.map(function (attr) {
            return that.camelCase2Dash(attr);
        })
    },

    getPlainStyle(target) {
        let that = this;
        if (!target) {
            return '';
        }
        var style = '';
        if (typeof target === 'string') {
            style = target;
        } else if (typeof target === 'object') {
            var dashAttr = '';
            Object.keys(target).forEach(function (attr) {
                dashAttr = that.camelCase2Dash(attr);
                if (target[attr]) {
                    if (that.dashedSizeAttrs().indexOf(dashAttr) > -1 || SizeAttrs.indexOf(attr) > -1) {
                        style += dashAttr + ': ' + that.getUnitizedValue(target[attr]) + ';';
                    } else {
                        style += dashAttr + ': ' + target[attr] + ';';
                    }
                }
            });
        }
        return style;
    }
}