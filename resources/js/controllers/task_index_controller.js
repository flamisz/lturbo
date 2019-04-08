import { Controller } from "stimulus"

export default class extends Controller {
    static targets = [ "times", "button" ]

    connect() {
        console.log("task index stimulus")
    }

    form() {
        event.preventDefault()
        console.log("new task")
    }
}
