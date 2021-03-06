//
//  BusinessesViewController.swift
//  Yelp
//
//  Created by Timothy Lee on 4/23/15.
//  Copyright (c) 2015 Timothy Lee. All rights reserved.
//

import UIKit

class BusinessesViewController: UIViewController, UITableViewDataSource, UITableViewDelegate, UISearchBarDelegate {

    @IBOutlet var tableView: UITableView!
    var businesses: [Business]!
    let searchBar = UISearchBar()
    //This array below will be used to append into searched items
    var filteredData: [Business]!

    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        //Stylize navigation
        self.navigationItem.title = "Yelp"
        if let navigationBar = navigationController?.navigationBar {
            
            navigationBar.tintColor = UIColor.blueColor()
            
            let shadow = NSShadow()
            shadow.shadowColor = UIColor.blueColor().colorWithAlphaComponent(0)
            shadow.shadowOffset = CGSizeMake(2, 2);
            shadow.shadowBlurRadius = 2;
            navigationBar.titleTextAttributes = [
                
                NSFontAttributeName : UIFont.boldSystemFontOfSize(22),
                NSForegroundColorAttributeName : UIColor.blueColor(),
                NSShadowAttributeName : shadow
            ]
        }

        searchBar.sizeToFit()
        navigationItem.titleView = searchBar
        
        tableView.delegate = self
        tableView.dataSource = self
        searchBar.delegate = self
        tableView.rowHeight = UITableViewAutomaticDimension
        tableView.estimatedRowHeight = 120
        
        filteredData = businesses
        

        Business.searchWithTerm("Thai", completion: { (businesses: [Business]!, error: NSError!) -> Void in
            self.businesses = businesses
            
            self.filteredData = self.businesses
            self.tableView.reloadData()
        
            for business in businesses {
                print(business.name!)
                print(business.address!)
            }
        })
        
        
        

/* Example of Yelp search with more search options specified
        Business.searchWithTerm("Restaurants", sort: .Distance, categories: ["asianfusion", "burgers"], deals: true) { (businesses: [Business]!, error: NSError!) -> Void in
            self.businesses = businesses
            
            for business in businesses {
                print(business.name!)
                print(business.address!)
            }
        }
*/
    }
    
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if let businesses = filteredData{
            return businesses.count
        }
        else {
            return 0
        }
    }
    
    //Searching method
    
    func searchBar(searchBar: UISearchBar, textDidChange searchText: String) {
        if searchText.isEmpty {
            filteredData = businesses
        } else {
            var tempArray = [Business]()
            
            for business in businesses! {
                if(business.name!.lowercaseString.rangeOfString(searchText.lowercaseString) != nil) {
                    tempArray.append(business)
                }
            }
            
            filteredData = tempArray
        }
        
        tableView.reloadData()
    }
    
    
    
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCellWithIdentifier("BusinessCell", forIndexPath: indexPath) as! BusinessCell
        cell.business = filteredData[indexPath.row]
        
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
