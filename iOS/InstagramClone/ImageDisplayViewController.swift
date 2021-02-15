//
//  ImageDisplayViewController.swift
//  InstagramClone
//
//  Created by Mary T Mathai on 3/14/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit
import Parse

class ImageDisplayViewController: UIViewController, UIImagePickerControllerDelegate, UINavigationControllerDelegate {

    let vc = UIImagePickerController()
    
    
    @IBOutlet weak var homeButton: UIButton!
    @IBOutlet weak var pictureImageView: UIImageView!
    
    @IBOutlet weak var captionTextView: UITextView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        
               
    }
    
    
    @IBAction func onPickImage(sender: AnyObject) {
        vc.delegate = self
        vc.allowsEditing = true
        vc.sourceType = UIImagePickerControllerSourceType.PhotoLibrary
        
        self.presentViewController(vc, animated: true, completion: nil)

    }
    
    @IBAction func onUseCamera(sender: AnyObject) {
    
        if UIImagePickerController.isSourceTypeAvailable(UIImagePickerControllerSourceType.Camera){
            
            vc.delegate = self
            vc.allowsEditing = true
            vc.sourceType = UIImagePickerControllerSourceType.Camera
        
            self.presentViewController(vc, animated: true, completion: nil)
        }
    }
    
//    func imagePickerController(picker: UIImagePickerController,
//        didFinishPickingMediaWithInfo info: [String : AnyObject]) {
//            // Get the image captured by the UIImagePickerController
//            let originalImage = info[UIImagePickerControllerOriginalImage] as! UIImage
//            let editedImage = info[UIImagePickerControllerEditedImage] as! UIImage
//            
//            // Do something with the images (based on your use case)
//            pictureImageView.image = image
//            
//            // Dismiss UIImagePickerController to go back to your original view controller
//            dismissViewControllerAnimated(true, completion: nil)
//    }
    
    func imagePickerController(picker: UIImagePickerController!, didFinishPickingImage image: UIImage!, editingInfo: NSDictionary!) {
        
        pictureImageView.image = image
        
        self.dismissViewControllerAnimated(true, completion: {})
    }
    
    @IBAction func onPost(sender: AnyObject) {
        if pictureImageView.image != nil || captionTextView.text != nil {
            
            Post.postUserImage(pictureImageView.image, withCaption: self.captionTextView.text, withCompletion: nil)
        }
            
        else {
            print("ERROR!")
        }
    }

    
    class Post: NSObject {
        /**
         * Other methods
         */
         
         /**
         Method to add a user post to Parse (uploading image file)
         
         - parameter image: Image that the user wants upload to parse
         - parameter caption: Caption text input by the user
         - parameter completion: Block to be executed after save operation is complete
         */
        class func postUserImage(image: UIImage?, withCaption caption: String?, withCompletion completion: PFBooleanResultBlock?) {
            // Create Parse object PFObject
            let post = PFObject(className: "Post")
            
            // Add relevant fields to the object
            post["media"] = getPFFileFromImage(image) // PFFile column type
            post["author"] = PFUser.currentUser() // Pointer column type that points to PFUser
            post["caption"] = caption
            post["likesCount"] = 0
            post["commentsCount"] = 0
            
            // Save object (following function will save the object in Parse asynchronously)
            post.saveInBackgroundWithBlock(completion)
        }
        
        /**
         Method to convert UIImage to PFFile
         
         - parameter image: Image that the user wants to upload to parse
         
         - returns: PFFile for the the data in the image
         */
        class func getPFFileFromImage(image: UIImage?) -> PFFile? {
            // check if image is not nil
            if let image = image {
                // get image data and check if that is not nil
                if let imageData = UIImagePNGRepresentation(image) {
                    return PFFile(name: "image.png", data: imageData)
                }
            }
            return nil
        }
    }
    

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
