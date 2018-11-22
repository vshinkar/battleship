window.onload = function () {

    'use strict';

    function getElement(id) {
        return document.getElementById(id);
    }

    function getRandom(n) {
        // n - max value
        return Math.floor(Math.random() * (n + 1));
    }

    function Instance(grid) {
        this.grid = grid;
        this.shots = [];
    }

    Instance.prototype.keypress = function (e) {

        if (this.hasShip() !== false)
            this.fire();
    }

    Instance.prototype.fire = function () {
        var a = getRandom(9);
        var b = getRandom(9)

        if (!this.shots.hasOwnProperty(a))
            this.shots[a] = [];

        if (this.shots[a].hasOwnProperty(b)) {

            return this.fire();
        }

        var val = this.grid[a][b];
        var className = parseInt(val) ? 'hit' : 'past';

        getElement(a + '_' + b).classList.add(className);

        this.shots[a][b] = true;
        this.grid[a][b] = 0;

        if (this.hasShip() === false)
            getElement('desc').innerHTML = 'Game Over!';

    }

    Instance.prototype.hasShip = function () {
        var exist = false;
        for (var i = 0; i < this.grid.length; i++) {
            for (var j = 0; j < this.grid[i].length; j++) {
                if (parseInt(this.grid[i][j]) === 1)
                    exist = true;
            }
        }

        return exist;
    }

    Instance.prototype.setObserver = function () {

        document.addEventListener('keypress', this.keypress.bind(this));

    }

    getElement('play').addEventListener('click', function (e) {

        getElement('play').remove();
        getElement('desc').setAttribute('data-hidden', false);

        // game initialisation
        Controller.battle.init();
    });

    var Controller = (function () {
        var battle = {
            // game initialisation
            init: function () {
                self = this;

                var instance = new Instance(grid);
                // event handlers
                instance.setObserver();
            }
        };

        return ({
            battle: battle,
            init: battle.init
        });

    })();


}