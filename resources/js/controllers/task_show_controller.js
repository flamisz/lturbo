import { Controller } from "stimulus"

export default class extends Controller {
    static targets = [ "times", "button" ]

    connect() {
        console.log("task show stimulus")
    }

    toggle() {
        event.preventDefault()
        let toggleAction = this.buttonTarget.dataset.toggleAction
        console.log(toggleAction)

        let url = this.data.get("url") + '/' + toggleAction
        let token = document.head.querySelector('meta[name="csrf-token"]')

        fetch(url, {
            method: "POST",
            headers:{
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token.content
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw Error(response.statusText)
                }
                return response
            })
            .then(response => response.text())
            .then(html => {
                this.timesTarget.innerHTML = html
                this.buttonTarget.classList.toggle("btn-outline-danger")
                this.buttonTarget.classList.toggle("btn-outline-success")
                this.buttonTarget.innerHTML = toggleAction == 'start' ? 'Stop' : 'Start'
                this.buttonTarget.dataset.toggleAction = toggleAction == 'start' ? 'stop' : 'start'
            })
            .catch(err => {
                console.log('Fetch Error :-S', err)
            })
    }

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
            .then(function(response) {
                if (!response.ok) {
                    throw Error(response.statusText)
                }
                return response
            })
            .then(response => response.text())
            .then(html => {
                this.timesTarget.innerHTML = html
            })
            .catch(err => {
                console.log('Fetch Error :-S', err)
            })
    }
}
