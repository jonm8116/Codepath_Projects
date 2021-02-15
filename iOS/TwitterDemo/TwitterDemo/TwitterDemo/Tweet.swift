//
//  Tweet.swift
//  TwitterDemo
//
//  Created by Mary T Mathai on 2/27/16.
//  Copyright © 2016 JonCo. All rights reserved.
//

import UIKit

class Tweet: NSObject {

    var text: NSString?
    var timestamp: NSDate?
    var retweetCount: Int = 0
    var favoritesCount: Int = 0
    var user: User?
    
    init(dictionary: NSDictionary){
        user = User(dictionary: dictionary["user"] as! NSDictionary)
        text = dictionary["text"] as? String
        retweetCount = (dictionary["retweet_count"] as? Int) ?? 0
        favoritesCount = (dictionary["favorites_count"] as? Int) ?? 0
        
        //In order to have a date parser you need a date formatter
        //Then you need to describe the format of your date
        let timestampString = dictionary["created_at"] as? String
        
        if let timestampString = timestampString{
            let formatter = NSDateFormatter()
            formatter.dateFormat = "EEE MMM d HH:mm:ss Z y"
            timestamp = formatter.dateFromString(timestampString)
        }
        
    }
    
    //The arrow specifies the return type of the function
    class func tweetsWithArray(dictionaries: [NSDictionary]) -> [Tweet] {
        //This method creates an empty array of tweets
        //Then iterate through all the dictionaries
        //Create a tweet based on that dictionary
        //Then add that tweet to the array
        //Then return that tweet 
       var tweets = [Tweet]()
        
        for dictionary in dictionaries{
            let tweet = Tweet(dictionary: dictionary)
            
            tweets.append(tweet)
        }
        
        return tweets
    }
    
}
