//
//  DetailViewController.swift
//  MovieViewer
//
//  Created by Mary T Mathai on 2/3/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class DetailViewController: UIViewController {

    @IBOutlet weak var posterImageView: UIImageView!
    
    @IBOutlet weak var titleLabel: UILabel!
    
    @IBOutlet weak var overviewLabel: UILabel!
    
    @IBOutlet weak var scrollView: UIScrollView!
    @IBOutlet weak var infoView: UIView!
    var movie: NSDictionary!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        scrollView.contentSize = CGSize(width: scrollView.frame.size.width, height: infoView.frame.origin.y + infoView.frame.size.height)
        
        let title = movie["title"] as? String
        titleLabel.text = title
        
        let overview = movie["overview"] as? String

        overviewLabel.text = overview
        
        overviewLabel.sizeToFit()
        
        let baseURL = "http://image.tmdb.org/t/p/w500"
        
        //This if statement will check to see if the posterPath is nill
        //If it is it will only return the cell
        if let posterPath = movie["poster_path"] as? String {
            
            let posterURL = NSURL(string: baseURL + posterPath)
            posterImageView.setImageWithURL(posterURL!)
            
        }
        
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
        
        print("prepare for segue is called")
        
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
