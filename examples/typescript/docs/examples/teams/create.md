import * as sdk from "appwrite";

// Init SDK
let client = new sdk.Client();

let teams = new sdk.Teams(client);

client
    .setProject('5df5acd0d48c2') // Your project ID
;

let promise = teams.create('[NAME]');

promise.then(function (response) {
    console.log(response);
}, function (error) {
    console.log(error);
});