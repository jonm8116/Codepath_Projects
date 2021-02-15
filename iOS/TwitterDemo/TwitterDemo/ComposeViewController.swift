//
//  ComposeViewController.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 3/7/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class ComposeViewController: UIViewController {

    @IBOutlet weak var profileImage: UIImageView!
    
    var tweet: Tweet!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        //profileImage.setImageWithURL((tweet!.user!.profileUrl)!)
        
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
