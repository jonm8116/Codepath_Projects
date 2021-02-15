//
//  TweetCell.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 2/27/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit
import AFNetworking

class TweetCell: UITableViewCell {

    
    @IBOutlet weak var profilePicture: UIImageView!
    
    @IBOutlet weak var userProfile: UIButton!
    @IBOutlet weak var username: UILabel!
    @IBOutlet weak var atUsername: UILabel!
    
    @IBOutlet weak var tweetText: UILabel!
    @IBOutlet weak var timestamp: UILabel!
    
    
    var tweet: Tweet! {
        didSet{
            tweetText.text = tweet.text as? String
            self.username.text = tweet.user?.name as? String
            self.atUsername.text = "@\(tweet.user!.screenname!)"
            timestamp.text = "\(tweet!.timestamp!)"
            profilePicture.setImageWithURL((tweet!.user!.profileUrl)!)
            
            
        }
    }
    
    
    override func awakeFromNib() {
        super.awakeFromNib()
        profilePicture.layer.cornerRadius = 3
        profilePicture.clipsToBounds = true
        
        username.preferredMaxLayoutWidth = username.frame.width
        
    }

    override func setSelected(selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
