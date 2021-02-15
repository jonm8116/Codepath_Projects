//
//  TwitterClient.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 2/27/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit
import BDBOAuth1Manager

class TwitterClient: BDBOAuth1SessionManager {

    //static indicates that it cannot be overriden 
    //static allows you to directly call the variable from the class
    //static refers to this class
    static let sharedInstance = TwitterClient(baseURL: NSURL(string: "https://api.twitter.com")!, consumerKey: "id6cYRkiSOF2HUWnq46XQMI2z", consumerSecret: "THzAWdsOKCNKIFOVqtzFNmQzBkxGz2B7m8OOTgDhRdyzBt3eAc")
    var loginSuccess: (() -> ())?
    var loginFailure: ((NSError) -> ())?
    
    
    //Later look up how to declare a closure type
    func login(success: () ->(), failure: (NSError) ->()) {
        loginSuccess = success
        loginFailure = failure
        
        
        //This deauthorize method is a way of logging out
        TwitterClient.sharedInstance.deauthorize()
        TwitterClient.sharedInstance.fetchRequestTokenWithPath("oauth/request_token", method: "GET", callbackURL: NSURL(string: "mytwitterdemo://oauth"), scope: nil, success: {(requestToken: BDBOAuth1Credential!) -> Void in
            
            
            //Query parameters start with question mark in the string
            let url = NSURL(string: "https://api.twitter.com/oauth/authorize?oauth_token=\(requestToken.token)")!
            //This openURL method allows the user to switch out of the app and open up another app
            //Ask later what types of "things" can you call the method openURL on?
            UIApplication.sharedApplication().openURL(url)
            
            }) { (error: NSError!) -> Void in
                print("error: \(error.localizedDescription)")
                self.loginFailure?(error)
        }
    }
    
    func logout() {
        User.currentUser = nil
        deauthorize()
        
        NSNotificationCenter.defaultCenter().postNotificationName(User.userDidLogoutNotification, object: nil)
    }
    
    func handleOpenUrl(url: NSURL) {
        let requestToken = BDBOAuth1Credential(queryString: url.query)
        
       fetchAccessTokenWithPath("oauth/access_token", method: "POST", requestToken: requestToken, success: { (accessToken: BDBOAuth1Credential!) -> Void in
        
        self.currentAccount({ (user: User) -> () in
            User.currentUser = user //this line will call the setter and save
            self.loginSuccess?()
            
            }, failure: { (error: NSError) -> () in
                        self.loginFailure?(error)
        })
        
                self.loginSuccess?()
            
            
            }) {(error: NSError!) -> Void in
                print("error: \(error.localizedDescription)")
                self.loginFailure?(error)
        }
    }

    //What's inside the parameter delcares a closure
    func homeTimeline (success: ([Tweet]) ->(), failure: (NSError) ->()) {
        GET("1.1/statuses/home_timeline.json", parameters: nil, progress: nil, success: { (task: NSURLSessionDataTask, response: AnyObject?) -> Void in
            let dictionaries = response as! [NSDictionary]
            
            //You were able to call this method based on the class (b/c its a class function)
            let tweets = Tweet.tweetsWithArray(dictionaries)
            
            success(tweets)
            }, failure: { (task: NSURLSessionDataTask?, error: NSError) -> Void in
            failure(error)
        })

    }
    
    func currentAccount(success: (User) ->(), failure: (NSError) -> ()) {
        GET("1.1/account/verify_credentials.json", parameters: nil, progress: nil, success: { (task: NSURLSessionDataTask, response: AnyObject?) -> Void in
            print("account: \(response)")
            let userDictionary = response as! NSDictionary
            let user = User(dictionary: userDictionary)
            
            success(user)
            
            //print("name: \(user.name)")
            //print("screenname: \(user.screenname)")
            //print("profile url: \(user.profileUrl)")
            //print("description: \(user.tagline)")
            }, failure: { (task: NSURLSessionDataTask?, error: NSError) -> Void in
            failure(error)
                
        })
        
    }
}
