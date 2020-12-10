/* ========================================================================
 * jstrapplayer.js v0.0.1
 * https://github.com/ambitionphp/jStrapPlayer
 * ========================================================================
 * Copyright 2018 Steven Sarkisian
 * Licensed under MIT (https://github.com/ambitionphp/jStrapPlayer/blob/master/LICENSE)
 * ======================================================================== */

+function ($) {
    'use strict';
    var jStrapPlayer = function (element, options) {
        var self = this;
        this.$element = $(element);
        this.options = $.extend({}, jStrapPlayer.DEFAULTS, this.$element.data(), options);
        var inside = this;

        if( !$('#jStrapPlayerStyle').length ) {
            $('head').append('<style id="jStrapPlayerStyle" type="text/css">.jp-audio .fa-pause,.jp-state-playing .fa-play{display:none}.jp-state-playing .fa-pause{display:inline-block}.jp-playlist-current a.d-inline-block{font-weight:700}.jp-playlist span.pull-right{font-size:75%}</style>');
        }

        if(typeof inside.options.media.length !== 'undefined')
        {
            new jPlayerPlaylist({
                jPlayer: this.$element,
                cssSelectorAncestor: this.options.cssSelectorAncestor
            }, this.options.media, {
                swfPath: this.options.swfPath,
                supplied: this.options.supplied,
                wmode: this.options.wmode,
                useStateClassSkin: this.options.useStateClassSkin,
                autoBlur: this.options.autoBlur,
                smoothPlayBar: this.options.smoothPlayBar,
                keyEnabled: this.options.keyEnabled,
                remainingDuration: this.options.remainingDuration,
                toggleDuration: this.options.toggleDuration,
                playlistOptions: {
                    freeGroupClass: "pull-right",
                    itemClass: "d-inline-block"
                },
                play: function() {
                    $(this).jPlayer("pauseOthers"); // pause all players except this one.
                }
            });
        }
        else
        {
            $(this.$element).jPlayer({
                ready: function (event) {
                    var bs_jp = $(this);
                    bs_jp.jPlayer("setMedia", inside.options.media);
                    $(bs_jp.jPlayer("option", "cssSelectorAncestor")).find('.bs-volume').data("container", bs_jp.jPlayer("option", "cssSelectorAncestor"));
                    $(bs_jp.jPlayer("option", "cssSelectorAncestor")).find('.bs-volume').data("content", "<input type='range' class='custom-range' min='0' max='100' value='"+(event.jPlayer.options.volume * 100)+"'>");
                    $(document).on('change mousemove', bs_jp.jPlayer("option", "cssSelectorAncestor")+ ' input[type=range]', function(e) {
                        bs_jp.jPlayer("volume", $(this).val() / 100);
                    });
                    console.log($(bs_jp.jPlayer("option", "cssSelectorAncestor")+' [data-toggle="popover"]'));
                    $(bs_jp.jPlayer("option", "cssSelectorAncestor")+' [data-toggle="popover"]').popover();
                    $('body').on('click', function (e) {
                        $(bs_jp.jPlayer("option", "cssSelectorAncestor")+' [data-toggle="popover"]').each(function () {
                            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                                $(this).popover('hide');
                            }
                        });
                    });
                },
                swfPath: this.options.swfPath,
                supplied: this.options.supplied,
                wmode: this.options.wmode,
                cssSelectorAncestor: this.options.cssSelectorAncestor,
                useStateClassSkin: this.options.useStateClassSkin,
                autoBlur: this.options.autoBlur,
                smoothPlayBar: this.options.smoothPlayBar,
                keyEnabled: this.options.keyEnabled,
                remainingDuration: this.options.remainingDuration,
                toggleDuration: this.options.toggleDuration,
                play: function() {
                    $(this).jPlayer("pauseOthers"); // pause all players except this one.
                }
            });
        }
    };

    jStrapPlayer.DEFAULTS = {
        cssSelectorAncestor: '#jp_container_1',
        swfPath: 'jplayer',
        supplied: 'm4a, oga',
        wmode: 'window',
        autoBlur: false,
        smoothPlayBar: false,
        keyEnabled: true,
        remainingDuration: false,
        toggleDuration: true,
        media: [
            {
                title: "Bubble",
                m4a: "http://jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
                oga: "http://jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
            },
            {
                title: "Bubble",
                m4a: "http://jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
                oga: "http://jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
            }
        ]
    };

    jStrapPlayer.prototype.setOptions = function (options) {
        if (typeof options == 'object') {
            this.options = $.extend({}, this.options, options);
        }
    };

    var old = $.fn.jStrapPlayer;

    $.fn.jStrapPlayer = function (option, arg) {
        var options = typeof option == 'object' && option;
        var data = new jStrapPlayer(this, options);

        if (typeof option == 'object') {
            data.setOptions(option);
        } else if (typeof option == 'string') {
            data[option](arg);
        }
    };

    $.fn.jStrapPlayer.Constructor = jStrapPlayer;

    $.fn.jStrapPlayer.noConflict = function () {
        $.fn.jStrapPlayer = old;
        return this;
    };

}(jQuery);
