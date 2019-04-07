
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { Application } from "stimulus";

import StartstopController from "./controllers/startstop_controller";

const application = Application.start();
application.register("startstop", StartstopController);
