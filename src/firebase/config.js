import firebase from 'firebase'
import 'firebase/firestore'

const firebaseConfig = {
    apiKey: "AIzaSyB1ix0ifuTQKe4c1vYL3HQn2VWh_n-qTII",
    authDomain: "happywriters-8c65d.firebaseapp.com",
    projectId: "happywriters-8c65d",
    storageBucket: "happywriters-8c65d.appspot.com",
    messagingSenderId: "170121118267",
    appId: "1:170121118267:web:55df061984e7512848d21e"
  };

firebase.initializeApp(firebaseConfig);
let db=firebase.firestore()

export {db}