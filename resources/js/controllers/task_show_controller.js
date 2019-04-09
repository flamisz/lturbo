import { Controller } from "stimulus"

export default class extends Controller {
    static targets = [ "times", "button" ]

    toggle() {
        event.preventDefault()

        let token = document.head.querySelector('meta[name="csrf-token"]')
        let buttonText = this.buttonTarget.innerHTML
        let buttonTextMapping = {"Start": "Stop", "Stop": "Start"}

        fetch(this.data.get("url"), {
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
                this.buttonTarget.innerHTML = buttonTextMapping[buttonText]
            })
            .catch(err => {
                console.log('Fetch Error :-S', err)
            })
    }
}
