import { Controller } from "stimulus"

export default class extends Controller {
    stop() {
        event.preventDefault();

        let stopUrl = this.data.get("url") + "/stop";
        let token = document.head.querySelector('meta[name="csrf-token"]');

        fetch(stopUrl, {
            method: "POST",
            headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token.content
                }
            })
            .then(Turbolinks.clearCache())
            .then(Turbolinks.visit(this.data.get("url")))
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });
    }

    start() {
        event.preventDefault();

        let startUrl = this.data.get("url") + "/start";
        let token = document.head.querySelector('meta[name="csrf-token"]');

        fetch(startUrl, {
            method: "POST",
            headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token.content
                }
            })
            .then(Turbolinks.clearCache())
            .then(Turbolinks.visit(this.data.get("url")))
            .catch(function(err) {
                console.log('Fetch Error :-S', err);
            });
    }
}
