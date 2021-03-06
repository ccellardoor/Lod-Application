PK  ⽎G              META-INF/MANIFEST.MF��  �M��LK-.�K-*��ϳR0�3���� PK��      PK
    ʽ�G�Ί��*  �*     elod/msg/Notifications.class����   3�  elod/msg/Notifications  java/lang/Object devName Ljava/lang/String; appName userName source DB_USER DB_PASS DB_ADDRS successList Ljava/util/List; 	Signature $Ljava/util/List<Lelod/msg/msgBody;>; 	errorList 
publicList warningList <init> K(Ljava/lang/String;Ljava/lang/String;Ljava/lang/String;Ljava/lang/String;)V Code
     ()V	    	    	    	  ! 	 	  # 
 	  %  	  '   ) java/util/ArrayList
 ( 	  ,  	  .  	  0  	  2   LineNumberTable LocalVariableTable this Lelod/msg/Notifications; 
sourceName user app dev main ([Ljava/lang/String;)V	 > @ ? java/lang/System A B out Ljava/io/PrintStream; D OUsage ---.jar [pathToMessageFile] [application information] [DB Authentication]
 F H G java/io/PrintStream I J println (Ljava/lang/String;)V L W	 [pathToMessageFile]: the full path to the file containing the messages to be uploaded N 	 [application information]... P E	 [DB Authentication]: the authentication parameters for the Database R ;	 This might be:
		-f: a file containing the authentication T ?	 OR
		-u: the username
		-p: the password
		-a: the DB address
 > V W X exit (I)V
  
 [ ] \ java/lang/String ^ _ hashCode ()I a -A
 [ c d e equals (Ljava/lang/Object;)Z g -F i -P k -U m -a o -f q -p s -u u java/io/File
 t w  J
  y z { DbCredentials (Ljava/io/File;)V
  } ~ J 	setDbUser
  � � J 	setDbPass
  � � J 	setDbAdrs � java/lang/StringBuilder � DB ADDRESS:
 � w
 � � � � append -(Ljava/lang/String;)Ljava/lang/StringBuilder;
 � � � � toString ()Ljava/lang/String; � -as
 [ � � � equalsIgnoreCase (Ljava/lang/String;)Z
  � � J 	setSource � -at
  � � J setApp � -dn
  � � J setDev � -au
  � � J setUser
  � � J readFile args [Ljava/lang/String; execute i I StackMapTable
 t � � � isFile ()Z � java/io/BufferedReader � java/io/FileReader
 � �  {
 � �  � (Ljava/io/Reader;)V
 [ � � _ length � ,
 [ � � � split '(Ljava/lang/String;)[Ljava/lang/String; � error � elod/msg/msgBody
 � �  � '(Ljava/lang/String;Ljava/lang/String;)V � � � java/util/List � e add � public � success � warning
 � � � � readLine
 � � � java/io/IOException �  printStackTrace � SIZE � � � _ size
 � � � � (I)Ljava/lang/StringBuilder;
  � � � 	runInsert � 
not a file filepath file Ljava/io/File; data br Ljava/io/BufferedReader; 	dataArray e Ljava/io/IOException; � 
initialise 9(Ljava/lang/String;Ljava/lang/String;Ljava/lang/String;)V pass adrs � java/util/Properties
 �  java/io/FileInputStream
 �
 � load (Ljava/io/InputStream;)V	 Password
 � getProperty &(Ljava/lang/String;)Ljava/lang/String; Username DataBase 	Developer Application User Source credentials prop Ljava/util/Properties; addError java/text/SimpleDateFormat! yyyy/MM/dd HH:mm:ss
 w$ java/util/Date
# 
'() format $(Ljava/util/Date;)Ljava/lang/String; msg 
dateFormat Ljava/text/SimpleDateFormat; 
addSuccess 
addWarning 	addPublic 	sendEmail L(Ljava/lang/String;Ljava/lang/String;[Ljava/lang/String;Ljava/lang/String;)V password 
recepients subject save Insert
8:9 java/sql/DriverManager;< getConnection M(Ljava/lang/String;Ljava/lang/String;Ljava/lang/String;)Ljava/sql/Connection;
 [>?@ valueOf &(Ljava/lang/Object;)Ljava/lang/String;B 
DFE java/sql/ConnectionGH createStatement ()Ljava/sql/Statement;J #select Id from Source where Title='L 'NPO java/sql/StatementQR executeQuery ((Ljava/lang/String;)Ljava/sql/ResultSet;TVU java/sql/ResultSetW � isBeforeFirstTYZ � next\ IdT^_` getInt (Ljava/lang/String;)Ib &INSERT INTO Source (`Title`) VALUES ('d ');Nfg` executeUpdateNij  closeTi
m �n java/sql/SQLExceptionp (select Id from Application where Title='r ' and Dev_Name='t ';v @INSERT INTO Application (`SourceID`,`Title`,`Dev_Name`) VALUES (x ,'z ','| ')~ 'select Id from Executions where AppId='� ' and User='� .INSERT INTO Executions (`AppId`,`User`)VALUES(� Error
 ��� inserts ;(Ljava/sql/Connection;Ljava/lang/String;Ljava/util/List;I)V ���  clear� Public� Success� Warning
 [�?� (I)Ljava/lang/String;� .. conn Ljava/sql/Connection; st Ljava/sql/Statement; sourceId rs Ljava/sql/ResultSet; Ljava/sql/SQLException; appId execId O(Ljava/sql/Connection;Ljava/lang/String;Ljava/util/List<Lelod/msg/msgBody;>;I)V� INSERT INTO � 0 (`ExecId`, `Message`,`Date_Time`)VALUES(?,?,?);D��� prepareStatement 0(Ljava/lang/String;)Ljava/sql/PreparedStatement;��� java/sql/PreparedStatement�� setInt (II)V� PRE FOR� !! � !! ���� get (I)Ljava/lang/Object;
 ��� � message� --
 ��� � date���� 	setString (ILjava/lang/String;)V�� � �� 	EXCEPTION table pstmt Ljava/sql/PreparedStatement; LocalVariableTypeTable isEmpty 
SourceFile Notifications.java !                      	     
                                                              �     i*� *� *� *� *�  *� "*� $*� &*� (Y� *� +*� (Y� *� -*� (Y� *� /*� (Y� *� 1*+�  *,� *� *-� �    3   F    -   	          "  '   2 ! = " H # S . X / ] 0 c 1 h 3 4   4    i 5 6     i 7     i 8     i 9     i :          �     T*� *� *� *� *�  *� "*� $*� &*� (Y� *� +*� (Y� *� -*� (Y� *� /*� (Y� *� 1�    3   6    4   	          "  '   2 ! = " H # S 4 4       T 5 6   	 ; <    �    �*�� 7� =C� E� =K� E� =M� E� =O� E� =Q� E� =S� E� U� Y� YL=�^*2YN� Z�   �     �   I  �   U  �   a  �   m  �   y  �   �  �   �  �   �-`� b� �� �-f� b� N� �-h� b� a� �-j� b� I� �-l� b� U� u-n� b� � i-p� b� 1� ]-r� b� � Q+� tY*`2� v� x� >+*`2� |� 2+*`2� � &+*`2� �� =� �Y�� �*`2� �� �� E*2�� �� +*`2� �� E*2�� �� +*`2� �� .*2�� �� +*`2� �� *2�� �� +*`2� ��*����+*2� ��    3   z    7  9  :  ;  < & = . > 6 ? : B B C G D � G L P S W  Y# ], ^F cQ eZ gh iq k m� o� q� C� w� x 4       � � �   Bn � 6  Dd � �  �   # :�  � P [� "  � J    -    � tY+� vM,� ��:� �Y� �Y,� �� �:� �-� �� � �-ö �:2ɶ �� *� -� �Y22� ͹ � W� x2ն �� *� /� �Y22� ͹ � W� P2׶ �� *� +� �Y22� ͹ � W� (2ٶ �� *� 1� �Y22� ͹ � W� �YN��I� 
:� ޲ =� �Y� �*� -� � � � �� E*� �W� � =� E�   � � �  3   Z    | 	 }    � $ � ' � 2 � : � F � _ � n � � � � � � � � � � � � � � � � �	 � � � 4   R    5 6     �   	 � �  ' � �   �  �    � � �  : � � �  �  � �  �   A 
� ' t [ �
� / �''� $   [ t  �  L �� %   [ t    � J     >     *+� �    3   
    �  � 4        5 6      :    � J     >     *+� �    3   
    �  � 4        5 6      9    � J     >     *+� �    3   
    �  � 4        5 6      8    � J     >     *+�  �    3   
    �  � 4        5 6      	    �      x     *+�  *,� *� *-� �    3       �  � 
 �  �  � 4   4     5 6      	      8      9      :    z �     d     *+� "*,� $*-� &�    3       �  � 
 �  � 4   *     5 6      8      �      �    z {    4     �� �Y� M,�Y+��*,�
� $*,�
� "*,�
� &,�
� *,�
� ,�
� *,�
� ,�
� *,�
� ,�
� *,�
�  � N-� ޱ   � � �  3   B    �  �  �  � * � 5 � ? � J � T � _ � i � t � ~ � � � � � � � 4   *    � 5 6     � �   �  �  � �  �    � J �B �  ~ J     >     *+� "�    3   
    �  � 4        5 6      8    � J     >     *+� $�    3   
     4        5 6      �    � J     >     *+� &�    3   
   	 
 4        5 6      �    J     o     )�Y �"M*� -� �Y,�#Y�%�&+� ͹ � W�    3        (' 4        ) 5 6     )*    +,  - J     o     )�Y �"M*� +� �Y,�#Y�%�&+� ͹ � W�    3      1 2 (3 4        ) 5 6     )*    +,  . J     o     )�Y �"M*� 1� �Y,�#Y�%�&+� ͹ � W�    3      > ? (A 4        ) 5 6     )*    +,  / J     o     )�Y �"M*� /� �Y,�#Y�%�&+� ͹ � W�    3      M N (O 4        ) 5 6     )*    +,  01     S      �    3      Y 4   4     5 6      8     2     3 �    4   5 J     5      �    3      ` 4        5 6      �   6 �     /     *� �    3      j 4        5 6    � �    K    YLM>*� &*� "*� $�7L� =� �Y*� &�=� �A� �*� "� �A� �*� $� �� �� E+�C M:,� �YI� �*�  � �K� �� ��M :�S � �X W[�] >� �,� �Ya� �*�  � �c� �� ��e W� =� �Ya� �*�  � �c� �� �� E,�h +�C M,� �YI� �*�  � �K� �� ��M :�X W[�] >�k ,�h �k � 
:�l6:+�C M,� �Yo� �*� � �q� �*� � �s� �� ��M :�S � �X W[�] 6� �,� �Yu� �� �w� �*� � �y� �*� � �{� �� ��e W,� �Yo� �*� � �q� �*� � �s� �� ��M :�X W[�] 6� 
:�l6:+�C M,� �Y}� �� �� �*� � �s� �� ��M :�S � �X W[�] 6� z,� �Y�� �� �w� �*� � �c� �� ��e W,� �Y}� �� �� �*� � �s� �� ��M :�X W[�] 6� 
:�l*+�*� -��*� -�� *+�*� /��*� /�� *+�*� +��*� +�� *+�*� 1��*� 1�� � �Y��� ��� �� ��  *-m7m��m  3   � =  m o q u v Gw Nx Qy sz }{ �| �} � �� �� �� ������#�*�/�4�7�:�A�p�z����������� ������#�P�Z�b�n�q�������������������$�-�;�D� 4   z   Y 5 6   W��  U��  S� �  Q ��� /  �� 7"� � : ���   �� @� �  ��� �  ��  �   L � �  DNT  � ��   DN m� \T� zBm� ZT� lBm ��     �       -� � � �:+� �Y�� �,� ��� �� ��� :�� � =� �Y�� �-� � � � �� E6� � =� �Y�� �,� ��� �-�� � ˶�� ��� �-�� � ˶�� �� �� E-�� � ˶��� -�� � ˶��� �� W�-� � ��|� -:� =� �Yȷ �-�� � ˶�� �� �� E�l�   � �m  3   F   � 
� � � +� -� 7� S� Y� �� �� �� �� �� ���� 4   R    5 6    ��   �     �    � �   ��  V � � �  � ( �� �       �   �   ( � M�� {�   D [ �� m) � �     [      *� -� *� /� *� +� *� 1� ��    3      � � � 4         5 6   �     �   �PK
    ʽ�Gj��9  9     elod/msg/Notifications.javapackage elod.msg;
/*
 /home/ilias/skaros/Dropbox/msgs.csv -u root -p salonika -a jdbc:mysql://127.0.0.1:3306/messenger -as sourceAS1 -at titleAT1 -dn devDN1 -au userAU1
 */

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Properties;
import java.sql.PreparedStatement;

public class Notifications {
	public String devName=null;
	public String appName=null;
	public String userName=null;
	public String source=null;
	public String DB_USER=null;
	public String DB_PASS=null;
	public String DB_ADDRS=null;
	List <msgBody> successList=new ArrayList<msgBody>();
	List <msgBody> errorList=new ArrayList<msgBody>();
	List <msgBody> publicList=new ArrayList<msgBody>();
	List <msgBody> warningList=new ArrayList<msgBody>();
	
	/**
	 * Constructor
	 * set up the necessary data prior of inserting to the database
	 * @param source the source of the data
	 * @param user the user
	 * @param app The application that created the message.
	 * @param dev The name of the developer
	 */
	public Notifications(String sourceName,String user,String app,String dev){
		source=sourceName; 
		userName=user;
		devName=dev;
		appName=app;
		
	}
	public Notifications(){}
	
	public static void main(String[] args) {
		if(args.length<2){
			//wrong parameters
			System.out.println("Usage ---.jar [pathToMessageFile] [application information] [DB Authentication]");
			System.out.println("\t [pathToMessageFile]: the full path to the file containing the messages to be uploaded");
			System.out.println("\t [application information]...");
			System.out.println("\t [DB Authentication]: the authentication parameters for the Database");
			System.out.println("\t This might be:\n\t\t-f: a file containing the authentication");
			System.out.println("\t OR\n\t\t-u: the username\n\t\t-p: the password\n\t\t-a: the DB address");
			System.exit(-1);
		}
		
		Notifications execute = new Notifications();
				for(int i=1;i<args.length;i=i+2){
					switch(args[i]){
					case "-f":
					case "-F":{
						execute.DbCredentials(new File(args[i+1]));
//						There is a file containning DB authentication
//						DB_USER=new GetCredential(args[i+1]).getProp("Username");
//						DB_PASS=new GetCredential(args[i+1]).getProp("Password");						
//						DB_ADDRS=new GetCredential(args[i+1]).getProp("DataBase");	
						break;
					}
					case "-u":
					case "-U":{
						execute.setDbUser(args[i+1]);
						
//							DB_USER=args[i+1];
							break;
						}
					case "-p":
					case "-P":{
						execute.setDbPass(args[i+1]);
//							DB_PASS=args[i+1];
							break;
						}
					case "-a":
					case "-A":{
						execute.setDbAdrs(args[i+1]);
						System.out.println("DB ADDRESS:"+args[i+1]);
//							DB_ADDRS=args[i+1];
							break;
						}						
					}//switch
					if(args[i].equalsIgnoreCase("-as")){
						//the source of data for the application						
						execute.setSource(args[i+1]);
//						source=args[i+1];
					}else if(args[i].equalsIgnoreCase("-at")){
						//the application name
						execute.setApp(args[i+1]);
//						appName=args[i+1];
					}else if(args[i].equalsIgnoreCase("-dn")){
						//the developers name
						execute.setDev(args[i+1]);
//						devName=args[i+1];
					}else if(args[i].equalsIgnoreCase("-au")){
						//the user of the application
						execute.setUser(args[i+1]);
//						userName=args[i+1];
					}
					
				}//for
			
		execute.readFile(args[0]);		
	}//main
	
	
	public  void readFile(String filepath){
		File file=new File(filepath);
		if(file.isFile()){
			String data;
			BufferedReader br = null;
			

			try {
				br = new BufferedReader(new FileReader(file));
				while ((data = br.readLine()) != null) {
					if (data.length()<5)continue ;
					String[] dataArray=data.split(",");
										
					if(dataArray[0].equalsIgnoreCase("error")){
						errorList.add(new msgBody(dataArray[1],dataArray[2]));
					}else if(dataArray[0].equalsIgnoreCase("public")){
						publicList.add(new msgBody(dataArray[1],dataArray[2]));
					}else if(dataArray[0].equalsIgnoreCase("success")){
						successList.add(new msgBody(dataArray[1],dataArray[2]));
					}else if(dataArray[0].equalsIgnoreCase("warning")){
						warningList.add(new msgBody(dataArray[1],dataArray[2]));
					}
					
				}
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			System.out.println("SIZE"+errorList.size());
			runInsert();
		}else System.out.println("not a file");
	}
	
	/**
	 * sets the developers name that will be used for the messages
	 * This is the name of the developer of the application that is used
	 * @param dev The name of the developer
	 */
	public void setDev(String dev){
		devName=dev;
	}
	
	/**
	 * sets the name of the application that created the message. 
	 * This should be identical to the other instances, in order to update the database table properly
	 * @param app The application that created the message.
	 */
	public void setApp(String app){
		this.appName=app;
	}
	
	/** 
	 * sets the name of the user that executed the application
	 * This could be empty or null
	 * @param user the user
	 */
	public void setUser(String user){
		this.userName=user;
	}
	
	/**
	 * sets the source that the application is handling. For example it can be "Espa", "Diaygeia" etch.
	 * This should be identical to the other instances, in order to update the database table properly
	 * @param source the source of the data
	 */
	public void setSource(String source){
		this.source=source;
	}
	
	/**
	 * set up the necessary data prior of inserting to the database
	 * @param source the source of the data
	 * @param user the user
	 * @param app The application that created the message.
	 * @param dev The name of the developer
	 */
	public void initialise(String source,String user,String app,String dev){
		this.source=source; 
		this.userName=user;
		this.devName=dev;
		this.appName=app;
	}
	/**
	 * set the database authentication parameters
	 * @param user the database username
	 * @param pass the password
	 * @param adrs the database url
	 */
	public void DbCredentials(String user,String pass,String adrs){
		 DB_USER=user;
		 DB_PASS=pass;
		 DB_ADDRS=adrs;
		 //TODO connect to DB
	}
	
	/**
	 * get the file containing the authentication parameters for the db connection
	 * @param credentials the properties file containing the DB authentication
	 */
	public void DbCredentials(File credentials){
		Properties prop = new Properties();
		try {
			prop.load(new FileInputStream(credentials));
			 DB_PASS= prop.getProperty("Password");
			 DB_USER= prop.getProperty("Username");
			 DB_ADDRS= prop.getProperty("DataBase");
			  
			 if(prop.getProperty("Developer")!=null)
				 devName= prop.getProperty("Developer");
			 if(prop.getProperty("Application")!=null)
				 appName=prop.getProperty("Application");
			 if(prop.getProperty("User")!=null)
				 userName=prop.getProperty("User");
			 if(prop.getProperty("Source")!=null)
				 source=prop.getProperty("Source");
				
				
		} catch (IOException e) {
			e.printStackTrace();					
		}
		 //TODO connect to DB
	}
	
	/**
	 * set the database user name
	 * @param user the database username
	 */
	public void setDbUser(String user){
		 DB_USER=user;
	}
	/**
	 * set the database password
	 * @param pass the database password
	 */
	public void setDbPass(String pass){
		 DB_PASS=pass;
	}
	/**
	 * set the database address
	 * @param adrs the database address
	 */
	public void setDbAdrs(String adrs){
		 DB_ADDRS=adrs;
	}

	
	
	
	

	/**
	 * insert the message passed to the database on table Success
	 * returns true if the insert was successful
	 * false if it failed and
	 * throws exception if the needed parameters are missing
	 * @param msg
	 */
	public void addError(String msg) {
		SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		errorList.add(new msgBody(dateFormat.format(new Date()),msg));
		
		
//		Connection conn = null;
//		Statement st = null;
//		try {
//			conn = DriverManager.getConnection(DB_ADDRS,DB_USER,DB_PASS);
//			st = conn.createStatement();
//		
//		} catch (SQLException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
	}
	
	/**
	 * insert the message passed to the database on table Success
	 * returns true if the insert was successful
	 * false if it failed and
	 * throws exception if the needed parameters are missing
	 * @param msg
	 */
	public void addSuccess(String msg) {
		SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		successList.add(new msgBody(dateFormat.format(new Date()),msg));
	}
	
	/**
	 * insert the message passed to the database on table Success
	 * returns true if the insert was successful
	 * false if it failed and
	 * throws exception if the needed parameters are missing
	 * @param msg
	 * @throws Exception 
	 */
	public void addWarning(String msg){
		SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		warningList.add(new msgBody(dateFormat.format(new Date()),msg));
		
	}
	
	
	/**
	 * insert the message passed to the database on table Public
	 * returns true if the insert was successful
	 * false if it failed and
	 * throws exception if the needed parameters are missing
	 * @param msg
	 * @throws Exception 
	 */
	public void addPublic(String msg){
		SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
		publicList.add(new msgBody(dateFormat.format(new Date()),msg));
	}
	/**
	 * send ALL the messages passed to the specified recipients, using a gmail account
	 * @param user the username of the gmail account, without the "@gmail.com"
	 * @param password the password of the account
	 * @param recepients a String array containing the recipients.
	 * @param subject the subject of the email
	 */
	public void sendEmail(String user,String password,String[] recepients,String subject){
		
	}
	/**
	 * read the file passed as a parameter, and copy insert the data to the database 
	 * @param file
	 */
	public void save(String file){
		
	}
//	public boolean runInsert(String user,String pass,String adrs){
//		conn = DriverManager.getConnection(user,USER,PASS);
//		st = conn.createStatement();
//		ResultSet rs=null;
//		return true;
//	}
	
	//File credentialsString user,String pass,String adrs
	public String Insert(){
		return runInsert();
	}
	public String runInsert(){
		Connection conn = null;
		
		Statement st = null;
//		
		int sourceId=-1;
		//find the id of the given source
		//if not found insert it
		try {
			conn = DriverManager.getConnection(DB_ADDRS,DB_USER,DB_PASS);//"jdbc:mysql://127.0.0.1:3306/messenger","root","salonika");
		System.out.println(DB_ADDRS+"\n"+DB_USER+"\n"+DB_PASS);
			st = conn.createStatement();
		ResultSet rs=null;
		rs= st.executeQuery("select Id from Source where Title='"+source+"'");
		 if (rs.isBeforeFirst()){
			 rs.next();
			 sourceId=  rs.getInt("Id");
		 }else{
			 //Source title was not found. insert it
			 st.executeUpdate("INSERT INTO Source (`Title`) VALUES ('"+source+"');");
			 System.out.println("INSERT INTO Source (`Title`) VALUES ('"+source+"');");
			 st.close();
			 st= conn.createStatement();
			 //now get the id of the inserted source 
			 rs= st.executeQuery("select Id from Source where Title='"+source+"'");
			 rs.next();
			 sourceId= rs.getInt("Id");
			 rs.close();
			 }
		 st.close();
		
		 rs.close();
		 
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		//find the application id, if already in the table. 
		//if not found insert it and then find it
		int appId=-1;
		try {
			ResultSet rs=null;
			st= conn.createStatement();
			rs= st.executeQuery("select Id from Application where Title='"+appName+"' and Dev_Name='"+devName+"';");
			 if (rs.isBeforeFirst()){
				 //application found. get the id
				 rs.next();
				 appId=  rs.getInt("Id");
			 }
			 else{
				 //application not found, insert it and then find it
				 st.executeUpdate("INSERT INTO Application (`SourceID`,`Title`,`Dev_Name`) VALUES ("+sourceId+",'"+appName+"','"+devName+"')");
				 rs= st.executeQuery("select Id from Application where Title='"+appName+"' and Dev_Name='"+devName+"';");
				 rs.next();
				 appId=  rs.getInt("Id");				 
			 }
			
			
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		//insert the data to the execution table
		int execId=-1;
		try {
			ResultSet rs=null;
			st= conn.createStatement();
			rs= st.executeQuery("select Id from Executions where AppId='"+appId+"' and User='"+userName+"';");
			if (rs.isBeforeFirst()){
				//execution found. get the id
				rs.next();
				execId=  rs.getInt("Id");
			}
			else{
				st.executeUpdate("INSERT INTO Executions (`AppId`,`User`)VALUES("+appId+",'"+userName+"');");
				rs= st.executeQuery("select Id from Executions where AppId='"+appId+"' and User='"+userName+"';");
				rs.next();
				execId=  rs.getInt("Id");	
			}
			
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		//now insert the messages on the appropriate tables
		inserts(conn,"Error",errorList,execId);
		errorList.clear();
		
		inserts(conn,"Public",publicList,execId);
		publicList.clear();
		
		inserts(conn,"Success",successList,execId);
		successList.clear();
		
		inserts(conn,"Warning",warningList,execId);
		warningList.clear();
	
		return sourceId+"..";
	}
	
	public void inserts(Connection conn,String table,List<msgBody> data,int execId){
		if (data.size()<1)
			return;
		PreparedStatement pstmt =null;
		try {
			pstmt =
	    		    conn.prepareStatement("INSERT INTO "+table+" (`ExecId`, `Message`,`Date_Time`)VALUES(?,?,?);");
			pstmt.setInt(1,execId);
			System.out.println("PRE FOR"+data.size());
			for (int i=0;i<data.size();i++){
				System.out.println("!! "+table+"!!"+data.get(i).message()+"--"+data.get(i).date());
				pstmt.setString(2,data.get(i).message());
				pstmt.setString(3,data.get(i).date());	
			pstmt.execute();			
			}
		} catch (SQLException e) {
			System.out.println("EXCEPTION"+data.get(0).date());
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public boolean isEmpty(){
		if(errorList==null&&publicList==null&&successList==null&&warningList==null)
			return true;
		else 
			return false;
	}

}
PK
    ���G�4@I�  �     elod/msg/GetCredential.class����   3 3  elod/msg/GetCredential  java/lang/Object fileName Ljava/lang/String; <init> (Ljava/lang/String;)V Code
     ()V	     LineNumberTable LocalVariableTable this Lelod/msg/GetCredential; file getProp &(Ljava/lang/String;)Ljava/lang/String;  java/util/Properties
    java/io/FileInputStream
    
      load (Ljava/io/InputStream;)V
  " #  getProperty
 % ' & java/io/IOException (  printStackTrace title prop Ljava/util/Properties; e Ljava/io/IOException; StackMapTable 0 java/lang/String 
SourceFile GetCredential.java !                	   F     
*� 
*+� �           
   	         
       
        	   �     $� Y� M,� Y*� � � ,+� !�N-� $�     %                  "     *    $       $ )     * +    , -  .    �    /   %  1    2PK
    [T�G�-��  �     elod/msg/GetCredential.javapackage elod.msg;

import java.io.FileInputStream;
import java.io.IOException;
import java.util.Properties;

public class GetCredential {
private String fileName;

	public GetCredential(String file){
		this.fileName=file;
	}

	
	public String getProp(String title){		
		Properties prop = new Properties();
		try {
			prop.load(new FileInputStream(fileName));
			return prop.getProperty(title);
		} catch (IOException e) {
			e.printStackTrace();
					return null;
		}
	}
	
	
	
}
PK
    ���G�T6=  =     elod/msg/msgBody.class����   3   elod/msg/msgBody  java/lang/Object date Ljava/lang/String; msg <init> '(Ljava/lang/String;Ljava/lang/String;)V Code
     ()V	    	     LineNumberTable LocalVariableTable this Lelod/msg/msgBody; ()Ljava/lang/String; message 
SourceFile msgBody.java !                   	  
   Y     *� *+� *,� �             	 	 
                                
   /     *� �                            
   /     *� �                             PK
    ��|GV��)  )     elod/msg/msgBody.javapackage elod.msg;

import java.util.Date;

public class msgBody{
	private final String date;
	private final String msg;
	public msgBody(String date,String msg){
		this.date=date;
		this.msg=msg;
		
	}
	public String date(){
		return this.date;
	}
	public String message(){
		return this.msg;
	}
}
PK   ⽎G��                      META-INF/MANIFEST.MF��  PK
 
    ʽ�G�Ί��*  �*               a   elod/msg/Notifications.classPK
 
    ʽ�Gj��9  9               n+  elod/msg/Notifications.javaPK
 
    ���G�4@I�  �               �d  elod/msg/GetCredential.classPK
 
    [T�G�-��  �               �h  elod/msg/GetCredential.javaPK
 
    ���G�T6=  =               �j  elod/msg/msgBody.classPK
 
    ��|GV��)  )               m  elod/msg/msgBody.javaPK      �  sn    