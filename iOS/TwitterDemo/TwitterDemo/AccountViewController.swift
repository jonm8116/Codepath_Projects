//
//  AccountViewController.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 3/6/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class AccountViewController: UIViewController, UITableViewDataSource, UITableViewDelegate {

    @IBOutlet weak var tableView: UITableView!
    @IBOutlet weak var backgroundImage: UIImageView!
    
    var user: User?
    var tweets: [Tweet]!
    
    var tweet: Tweet! {
        didSet{
            backgroundImage.setImageWithURL((tweet!.user!.backgroundImageURL)!)
        }
    }
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        tableView.delegate = self
        tableView.dataSource = self
        
        //let image = "https://si0.twimg.com/profile_background_images/80151733/oauth-dance.png" as String!
        //let imageURL = NSURL(string: image)!
        //backgroundImage.setImageWithURL(imageURL)
        
        //backgroundImage.setImageWithURL((tweet.user?.backgroundImageURL)!)
        
        
        TwitterClient.sharedInstance.homeTimeline({ (tweets: [Tweet]) -> () in
            self.tweets = tweets
            
            for tweet in tweets{
                self.tableView.reloadData()
                print(tweet.text)
            }
            }, failure: { (error: NSError) -> () in
                print(error.localizedDescription)
        })

        // Do any additional setup after loading the view.
    }

    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if tweets != nil{
            return tweets!.count
        }
        else {
            return 0
        }
    }
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCellWithIdentifier("AccountCell", forIndexPath: indexPath) as! AccountCell
        cell.tweet = tweets![indexPath.row]
        cell.selectionStyle = UITableViewCellSelectionStyle.None
        
        return cell
        
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
