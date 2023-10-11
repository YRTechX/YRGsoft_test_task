import { storage, ref, uploadBytes, getDownloadURL, deleteObject } from "@/firebase/init"
function saveImage(file){
    const storageRef = ref(storage, Date.now().toString())
    return uploadBytes(storageRef, file)
    .then((snapshot) => {
        return getDownloadURL(snapshot.ref);
    });
}
function deleteImage(imageUrl){
    const imgName = imageUrl.split('/').at(-1).split('?')[0]
    const imgRef = ref(storage, imgName);
    deleteObject(imgRef)
    .then(() => {
        console.log('Image deleted sucessfully')
    }).catch((error) => {
        console.log('Image delete failed, error: ' + error)
    });
}
function checkType(file){
    if (file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            return false
        }
        else return true
    }
}
export {saveImage, deleteImage, checkType} 