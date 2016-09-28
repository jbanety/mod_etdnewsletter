+function($) {

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function EtdNewsletter(element, options) {
        this.options = $.extend({}, EtdNewsletter.DEFAULTS, options);
        this.$element = $(element);

        this.init();
    }

    EtdNewsletter.DEFAULTS = {};

    EtdNewsletter.prototype.init = function() {

        var self = this;

        this.$element.find('[data-etdnewsletter="submit"]').on('click', function(e) {
            e.preventDefault();

            var $btn = $(this);
            $btn.prop('disabled', true).text('Envoi en cours...');

            var data = {
                id: self.$element.data('id'),
                email: self.$element.find('[data-etdnewsletter="email"]').val(),
                firstname: self.$element.find('[data-etdnewsletter="firstname"]').val(),
                lastname: self.$element.find('[data-etdnewsletter="lastname"]').val()
            };

            if (!validateEmail(data.email)) {
                alert("L'adresse email est invalide.");
                $btn.prop('disabled', false).text('Envoyer');
                return false;
            }

            $
                .post(self.$element.data('uri'), data)
                .done(function(json) {
                    if (!json.success) {
                        alert(json.message);
                        $btn.prop('disabled', false).text('Envoyer');
                    } else {
                        $btn.text('Merci !');
                    }
                })
                .fail(function() {
                    alert("une erreur inconnue est survenue.");
                    $btn.prop('disabled', false).text('Envoyer');
                })

        });

    };

    function Plugin(option) {
        return this.each(function() {
            var $this = $(this);
            var data = $this.data('etd.newsletter');
            var options = typeof option == 'object' && option;

            if (!data) {
                $this.data('etd.newslettery', (data = new EtdNewsletter(this, options)));
            }
            if (typeof option == 'string') {
                data[option]();
            }
        });
    }

    $(window).on('load.etd.newsletter.data-api', function() {
        $('[data-etd="newsletter"]').each(function() {
            var $newsletter = $(this);
            Plugin.call($newsletter, $newsletter.data());
        });
    })

}(jQuery);
