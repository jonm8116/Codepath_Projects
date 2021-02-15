//
//  AccountCell.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 3/6/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class AccountCell: UITableViewCell {

    @IBOutlet weak var profileImage: UIImageView!
    @IBOutlet weak var username: UILabel!
    @IBOutlet weak var atUsername: UILabel!
    @IBOutlet weak var timestamp: UILabel!
    @IBOutlet weak var tweetText: UILabel!
    
    var tweet: Tweet! {
        didSet{
            tweetText.text = tweet.text as? String
            self.username.text = tweet.user?.name as? String
            self.atUsername.text = "@\(tweet.user!.screenname!)"
            timestamp.text = "\(tweet!.timestamp!)"
            profileImage.setImageWithURL((tweet!.user!.profileUrl)!)
            
            
        }
    }

    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
        
        profileImage.layer.cornerRadius = 3
        profileImage.clipsToBounds = true
        
        username.preferredMaxLayoutWidth = username.frame.width

    }

    override func setSelected(selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
