//
//  PhotoCell.swift
//  InstagramClone
//
//  Created by Mary T Mathai on 3/20/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit
import Parse

class PhotoCell: UITableViewCell {

    @IBOutlet weak var photoImageView: UIImageView!
    @IBOutlet weak var cellCaptionText: UILabel!
    
    var getPhotoandCaption: PFObject! {
        didSet {
            //minorText:String = getPhotoandCaption["caption"] as? String
            self.cellCaptionText.text = " \(getPhotoandCaption["caption"])"
            //self.authorLabel.text = " by \(getPhotoandCaption["author"]!.username!! as String)"
            print(PFUser.currentUser()!.username! as String)
            
            
            if let userPicture = getPhotoandCaption["media"] as? PFFile {
                userPicture.getDataInBackgroundWithBlock { (imageData: NSData?, error: NSError?) -> Void in
                    if (error == nil) {
                        self.photoImageView.image = UIImage(data:imageData!)
                    }
                }
            }
        }
    }
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
