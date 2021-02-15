//
//  TweetDisplayedViewController.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 3/7/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class TweetDisplayedViewController: UIViewController {

    //Look up movies video for navigation
    
    @IBOutlet weak var profileImage: UIImageView!
    @IBOutlet weak var username: UILabel!
    @IBOutlet weak var atUsername: UILabel!
    @IBOutlet weak var timestamp: UILabel!
    @IBOutlet weak var tweetText: UILabel!
    
    var tweet: Tweet!
    
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        tweetText.text = tweet!.text as? String
        self.username.text = tweet!.user?.name as? String
        self.atUsername.text = "@\(tweet!.user!.screenname!)"
        timestamp.text = "\(tweet!.timestamp!)"
        profileImage.setImageWithURL((tweet!.user!.profileUrl)!)
        
        let image = "https://si0.twimg.com/profile_background_images/80151733/oauth-dance.png" as String!
        let imageURL = NSURL(string: image)!
        
        
        //let imageURL = tweet.user?.profileUrl!
        profileImage.setImageWithURL(imageURL)


        // Do any additional setup after loading the view.
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
