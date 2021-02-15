//
//  User.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 2/27/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class User: NSObject {
    //A model has all the properties of the model at top 
    //This is the same as an object in object oriented programming
    
    var user: User?
    
    var name: NSString?
    var screenname: NSString?
    var profileUrl: NSURL?
    var tagline: NSString?
    var backgroundImageURL: NSURL?
    
    var dictionary: NSDictionary
    
    //This is an initializer
    //This is most likely similar to a constructor
    
    //This is also known as deserialization code
    //This code selectively populates the model with data from a dictionary
    //Models usually take care of serialization, deserialization and persistence
    init(dictionary: NSDictionary) {
        self.dictionary = dictionary

        name = dictionary["name"] as? String
        screenname = dictionary["name"] as? String
        
        let profileUrlString = dictionary["profile_image_url_https"] as? String
        let backgroundImageString = dictionary["profile_background_image_url_https"] as? String
        if let profileUrlString = profileUrlString {
            profileUrl = NSURL(string: profileUrlString)
        }
        if let backgroundimageString = backgroundImageString {
            backgroundImageURL = NSURL(string: backgroundimageString)
        }
        
        
        tagline = dictionary["description"] as? String
    }
    
    static let userDidLogoutNotification = "UserDidLogout"
    
    static var _currentUser: User?
    
    class var currentUser: User? {
        get {
            if _currentUser == nil {
            let defaults = NSUserDefaults.standardUserDefaults()
            
            let userData = defaults.objectForKey("currentUserData") as? NSData
        
            if let userData = userData{
                let dictionary = try! NSJSONSerialization.JSONObjectWithData(userData, options: []) as! NSDictionary
                _currentUser = User(dictionary: dictionary)
                }
                
            }
            return _currentUser
        }
        set(user) {
            _currentUser = user
            
            let defaults = NSUserDefaults.standardUserDefaults()
            
            if let user = user {
                let data = try! NSJSONSerialization.dataWithJSONObject(user.dictionary, options: [])
                
                defaults.setObject(data, forKey: "currentUserData")
            }
                
            else {
                defaults.setObject(nil, forKey: "currentUserData")
                
            }
            
            //This defaults.synchronize is similar to command S
            //It saves the value to disk
            defaults.synchronize()
            
        }
    }
    
}
