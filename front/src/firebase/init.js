// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getStorage, ref, uploadBytes, getDownloadURL, getMetadata, deleteObject } from "firebase/storage";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAV8fIPQqw9DwaSGcZU_hyFDVKZ0IpcBhE",
  authDomain: "testtaskyrgsoft.firebaseapp.com",
  projectId: "testtaskyrgsoft",
  storageBucket: "testtaskyrgsoft.appspot.com",
  messagingSenderId: "266780019048",
  appId: "1:266780019048:web:d293f8060b9014aa032edd"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const storage = getStorage();
export  { storage, ref, uploadBytes, getDownloadURL, getMetadata, deleteObject, app } 