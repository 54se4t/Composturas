// Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyDunAcHuZ7ftfTQ2etuwsuK__lrTOKxS5k",
    authDomain: "compostura-e2cd4.firebaseapp.com",
    projectId: "compostura-e2cd4",
    storageBucket: "compostura-e2cd4.appspot.com",
    messagingSenderId: "215528137298",
    appId: "1:215528137298:web:eabe8f8134f945bf27358b"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var URL = $('meta[name="baseURL"]').attr('content');

var googleProvider = new firebase.auth.GoogleAuthProvider();