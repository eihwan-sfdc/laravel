SELECT  socc.[SubscriberKey]                                                                                  AS 'ContactKey'
       ,socc.[JobId]                                                                                          AS 'JobId'
       ,socc.[Domain]                                                                                         AS 'Domain'
       ,socc.[ListID]                                                                                         AS 'ListID'
       ,socc.[BatchID]                                                                                        AS 'BatchID'
       ,'TRUE'                                                                                                AS 'Sent'
       ,j.[EmailName]                                                                                         AS 'MessageName'
       ,j.[EmailSubject]                                                                                      AS 'Subject'
       ,j.[EmailID]                                                                                           AS 'AssetId'
       ,socc.[EmailSentDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time'    AS 'SentDate'
       ,(CASE WHEN socc.[EmailOpenUnique] IS NULL THEN 'FALSE' ELSE 'TRUE' END )                              AS 'Opened'
       ,socc.[EmailOpenDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time'    AS 'OpenedDate'
       ,(CASE WHEN socc.[EmailClickUnique] IS NULL THEN 'FALSE' ELSE 'TRUE' END )                             AS 'Clicked'
       ,socc.[EmailClickDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time'   AS 'ClickedDate'
       ,(CASE WHEN socc.[Unsubscribed] IS NULL THEN 'FALSE' ELSE 'TRUE' END)                                  AS 'Unsubscribed'
       ,socc.[UnsubscribedDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time' AS 'UnsubscribedDate'
       ,(CASE WHEN socc.[Bounced] IS NULL THEN 'FALSE' ELSE 'TRUE' END)                                       AS 'Bounced'
       ,socc.[BouncedDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time'      AS 'BouncedDate'
       ,socc.[BounceType]                                                                                     AS 'BouncedType'
       ,socc.[BounceDetail]                                                                                   AS 'BouncedDetail'
       ,socc.[Delivered]                                                                                      AS 'Delivered'
       ,(CASE WHEN socc.[Delivered] = 'False' THEN 'TRUE' ELSE 'FALSE' END)                                   AS 'Undelivered'
       ,JR.JourneyName                                                                                        AS 'JourneyName'
       ,JR.JourneyID                                                                                          AS 'JourneyID'
       ,JR.VersionNumber                                                                                      AS 'JourneyVersion'
       ,JA.ActivityID                                                                                         AS 'ActivityID'
       ,JA.ActivityName                                                                                       AS 'ActivityName'
       ,GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'GMT Standard Time'               AS 'LastModifiedDate'
       ,JR.VersionID                                                                                          AS 'JourneyVersionID'
       ,'Email'                                                                                               AS 'ContactChannel'
       ,S.EmailAddress                                                                                        AS 'Email'
       ,(CASE WHEN SUBSTRING(REPLACE(JR.JourneyName,' ',''),12,4) = 'Surv' OR SUBSTRING(REPLACE(JR.JourneyName,' ',''),12,4) = 'Noti' THEN SUBSTRING(REPLACE(JR.JourneyName,' ',''),12,6) ELSE SUBSTRING(REPLACE(JR.JourneyName,' ',''),0,7) END) AS 'CampaignCode'
       ,(CASE WHEN ISNUMERIC(SUBSTRING(REPLACE(JR.JourneyName,' ',''),0,7)) = 1 THEN 'Campaign' WHEN SUBSTRING(REPLACE(JR.JourneyName,' ',''),12,6) = 'Survey' THEN 'Survey' WHEN SUBSTRING(REPLACE(JR.JourneyName,' ',''),12,4) = 'Noti' THEN 'Notification' ELSE NULL END ) AS 'ContactType'
FROM
(
	SELECT  ROW_NUMBER() OVER (PARTITION BY s.SubscriberKey,s.JobID ORDER BY s.BatchID DESC) AS Row_Num
	       ,s.AccountID
	       ,s.OYBAccountID
	       ,s.JobID
	       ,s.ListID
	       ,s.BatchID                                                                        AS 'BatchID'
	       ,s.SubscriberID                                                                   AS 'SubscriberID'
	       ,s.SubscriberKey
	       ,s.EventDate                                                                      AS 'EmailSentDate'
	       ,s.Domain
	       ,s.TriggererSendDefinitionObjectID
	       ,s.TriggeredSendCustomerKey
	       ,o.EventDate                                                                      AS 'EmailOpenDate'
	       ,o.IsUnique                                                                       AS 'EmailOpenUnique'
	       ,c.EventDate                                                                      AS 'EmailClickDate'
	       ,c.IsUnique                                                                       AS 'EmailClickUnique'
	       ,u.[IsUnique]                                                                     AS 'Unsubscribed'
	       ,u.[EventDate]                                                                    AS 'UnsubscribedDate'
	       ,b.[BounceCategory]                                                               AS 'BounceType'
	       ,b.[BounceSubcategory]                                                            AS 'BounceDetail'
	       ,b.[IsUnique]                                                                     AS 'Bounced'
	       ,b.[EventDate]                                                                    AS 'BouncedDate'
	       ,(CASE WHEN b.[IsUnique] IS NOT NULL THEN 'FALSE' ELSE 'TRUE' END)                AS 'Delivered'
	FROM [_Sent] s
	FULL OUTER JOIN [_Open] o
	ON s.[JobID] = o.[JobID] AND s.[BatchID] = o.[BatchID] AND s.[SubscriberKey] = o.[SubscriberKey] AND o.[IsUnique] = 1
	FULL OUTER JOIN [_Click] c
	ON s.[JobID] = c.[JobID] AND s.[BatchID] = c.[BatchID] AND s.[SubscriberKey] = c.[SubscriberKey] AND c.[IsUnique] = 1
	FULL OUTER JOIN [_Unsubscribe] u
	ON s.[JobID] = u.[JobID] AND s.[BatchID] = u.[BatchID] AND s.[SubscriberKey] = u.[SubscriberKey] AND u.[IsUnique] = 1
	FULL OUTER JOIN [_Bounce] b
	ON s.[JobID] = b.[JobID] AND s.[BatchID] = b.[BatchID] AND s.[SubscriberKey] = b.[SubscriberKey] AND b.[IsUnique] = 1
) AS socc
JOIN [_Job] j
ON socc.[JobID] = j.[JobID]
JOIN [_JourneyActivity] JA
ON socc.[TriggererSendDefinitionObjectID] = JA.[JourneyActivityObjectID]
JOIN [_Journey] JR
ON JA.[VersionID] = JR.[VersionID]
JOIN [_Subscribers] S
ON socc.[SubscriberID] = S.[SubscriberID]
WHERE LEN(socc.[SubscriberKey]) = 18 /*AND socc.[EmailSentDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time' >= '2023-06-01 00:00:00'*/
AND ((socc.[EmailSentDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time') >= DATEADD(hour, -6, CONVERT(DATETIME, CONVERT(DATE, DATEADD(day, -1, GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time')))) OR (socc.[EmailOpenDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time') >= DATEADD(hour, -6, CONVERT(DATETIME, CONVERT(DATE, DATEADD(day, -1, GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time')))) OR (socc.[EmailClickDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time') >= DATEADD(hour, -6, CONVERT(DATETIME, CONVERT(DATE, DATEADD(day, -1, GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time')))) OR (socc.[UnsubscribedDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time') >= DATEADD(hour, -6, CONVERT(DATETIME, CONVERT(DATE, DATEADD(day, -1, GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time')))) OR (socc.[BouncedDate] AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time') >= DATEADD(hour, -6, CONVERT(DATETIME, CONVERT(DATE, DATEADD(day, -1, GETDATE() AT TIME ZONE 'Central America Standard Time' AT TIME ZONE 'West Pacific Standard Time')))) )