
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { Application } from "stimulus";

import TaskShowController from "./controllers/task_show_controller";

const application = Application.start();
application.register("task-show", TaskShowController);
