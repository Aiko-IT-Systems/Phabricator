/**
 * @provides phuix-icon-view
 * @requires javelin-install
 *           javelin-dom
 */

JX.install('PHUIXIconView', {

  members: {
    _node: null,
    _icon: null,
    _color: null,
    _brand: false,

    setIcon: function(icon) {
      var node = this.getNode();
      if (this._icon) {
        JX.DOM.alterClass(node, this._icon, false);
      }
      this._icon = icon;
      JX.DOM.alterClass(node, this._icon, true);
      return this;
    },

    setColor: function(color) {
      var node = this.getNode();
      if (this._color) {
        JX.DOM.alterClass(node, this._color, false);
      }
      this._color = color;
      JX.DOM.alterClass(node, this._color, true);
      return this;
    },

    setBrand: function(brand) {
      var node = this.getNode();
      if (this._brand) {
        JX.DOM.alterClass(node, this._brand, false);
      }
      this._brand = brand;
      JX.DOM.alterClass(node, this._brand, true);
      return this;
    },

    getNode: function() {
      if (!this._node) {
        var brand = 'fa-solid';
        if (this._brand) {
          brand = 'fa-brands';
        }
        var attrs = {
          className: 'phui-icon-view phui-font-fa ' + brand
        };

        this._node = JX.$N('span', attrs);
      }

      return this._node;
    }
  }

});
